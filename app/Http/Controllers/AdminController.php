<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dipartimento;
use App\Models\User;
use App\Models\Prenotazione;
use App\Models\Prestazione;
use App\Models\Orario;
use App\Models\GiornoSettimana;
use App\Models\GiornoPrestazione;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{

    public function getDepartmentsData()
    {
        $departments = Dipartimento::with(['prestazioni.giorni', 'prestazioni.orari'])->get();

        $allPerformancesRaw = Prestazione::with(['giorni', 'orari'])->get();

        $departmentsData = $departments->mapWithKeys(function ($department) {
            return [
                $department->specializzazione => $department->prestazioni->map(function ($performance) {
                    return [
                        'tipologia' => $performance->tipologia,
                        'giorni'    => $performance->giorni->pluck('giorno')->all(),
                        'orari'     => $performance->orari->pluck('orario')->all()
                    ];
                })->all()
            ];
        });

        $allPerformances = $allPerformancesRaw->map(function ($performance) {
            return [
                'tipologia' => $performance->tipologia,
                'giorni'    => $performance->giorni->pluck('giorno')->all(),
                'orari'     => $performance->orari->pluck('orario')->all()
            ];
        });



        $data = [
            'departments'  => $departmentsData,
            'performances' => $allPerformances,
            'allowed_days' => GiornoSettimana::all()
        ];

        return view('admin-layouts.departments', compact('data'));
    }



    public function getPerformancesData()
    {
        $data = [
            'performances' => Prestazione::with('prenotazioni')->get(),
            'users' => User::where('ruolo', 'paziente')->get(),
            'reservations' => Prenotazione::all()
        ];

        return view('admin-layouts.performances', compact('data'));
    }

    public function getStaffData()
    {
        $data = User::where('ruolo', 'staff')->get();
        return view('admin-layouts.staff', compact('data'));
    }

    public function getAnalyticsData(Request $request)
    {
        // Make a redirection in case the url does contains the date parameters
        if (!$request->has('start_date') || !$request->has('end_date')) {
            return redirect()->route('amministratore.analytics', [
                'start_date' => now()->toDateString(),
                'end_date' => now()->toDateString(),
            ]);
        }

        $departments = Dipartimento::with(['prestazioni'])->get()->mapWithKeys(function ($dip) {
            return [
                $dip->specializzazione => $dip->prestazioni->map(function ($prestazione) {
                    return [
                        'tipologia' => $prestazione->tipologia,
                    ];
                })->all()
            ];
        });

        $startDate = $request->input('start_date', '1970-01-01');
        $endDate = $request->input('end_date', now()->toDateString());

        $data = [
            'performances' => Prestazione::all(),
            'departments' => $departments,
            'patients' => User::where('ruolo', 'paziente')->get(),
            'reservations' => Prenotazione::all(),
            'start_date' => $startDate,
            'end_date' => $endDate
        ];

        return view('admin-layouts.analytics', compact('data'));
    }

    public function createReservation(Request $request) {
        return 0;
    }

    public function deleteReservation(Request $request) {
        return 0;
    }

    public function updateReservation(Request $request)
    {
        $id = $request->input('reservation_id');
        $date = $request->input('appointment-datetime');
        $time = $request->input('appointment-time');

        $reservation = Prenotazione::find($id);
        if (!$reservation) {
            return redirect()->back()->with('error', 'Prenotazione non trovata');
        }

        $updated = $reservation->update([
            'data_prenotazione' => $date,
            'orario_prenotazione' => $time,
        ]);

        return redirect()->back()->with('success', 'Prenotazione aggiornata');
    }

    //
    //
    //

    public function dispatchStaffAction(Request $request)
    {
        $action = $request->input('action');

        switch ($action) {
            case 'create':
                $this->createStaff($request);
                break;

            case 'modify':
                $this->modifyStaff($request);
                break;

            case 'delete':
                $this->deleteStaff($request);
                break;
        }

        return redirect()->back()->with('success', 'Successo');
    }

    private function createStaff(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'name' => 'required|string',
            'surname' => 'required|string',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'username' => $request->input('username'),
            'nome' => $request->input('name'),
            'cognome' => $request->input('surname'),
            'data_nascita' => $request->input('date_of_birth'),
            'codice_fiscale' => $request->input('codice_fiscale'),
            'telefono' => $request->input('phone'),
            'email' => $request->input('email'),
            'indirizzo' => $request->input('address'),
            'password' => bcrypt($request->input('password')),
            'ruolo' => 'staff',
        ]);
    }

    private function modifyStaff(Request $request)
    {
        $user = User::find($request->input('id'));
        if (!$user) return;

        $request->validate([
            'username' => 'required|string|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->username = $request->input('username');
        $user->nome = $request->input('name');
        $user->cognome = $request->input('surname');
        $user->data_nascita = $request->input('date_of_birth');
        $user->telefono = $request->input('phone');
        $user->email = $request->input('email');
        $user->indirizzo = $request->input('address');

        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();
    }

    private function deleteStaff(Request $request)
    {
        $user = User::find($request->input('id'));
        if ($user) {
            $user->delete();
        }
    }

    //
    //
    //

    public function dispatchDepartmentAction(Request $request)
    {
        $action = $request->input('action');

        switch ($action) {
            case 'create':
                $departmentKey = $request->input('department_key');
                $departmentData = json_decode($request->input('department_data'), true);

                // Check if does not exits a department with the same name
                if (Dipartimento::where('specializzazione', $departmentKey)->exists()) {
                    return redirect()->back()->with('error', 'Dipartimento giá esistente.');
                }

                $department = new Dipartimento();
                $department->specializzazione = $departmentKey;
                $department->descrizione = '';
                $department->save();
            break;
            case 'delete':
                $departmentKey = $request->input('department_key');
                $department = Dipartimento::where('specializzazione', $departmentKey)->first();
                if ($department) {
                    $department->delete();
                }
                break;
            case 'modify':
                $this->handleModifyDepartment($request);
                break;
        }

        return redirect()->back()->with('success', 'Action performed');
    }

    private function handleModifyDepartment(Request $request)
    {
        // Get the target department and deserialize the associated json
        $departmentKey = $request->input('department_key');
        $departmentData = json_decode($request->input('department_data'), true);

        // Get the target department from the database and remove all the associated performances
        $department = Dipartimento::where('specializzazione', $departmentKey)->first();
        $department->prestazioni()->delete();

        // Per ogni prestazione nel JSON
        foreach ($departmentData as $performanceData) {
            $tipologia = $performanceData['tipologia'];

            // Crea la prestazione se non esiste già
            $prestazione = \App\Models\Prestazione::firstOrCreate(
                ['tipologia' => $tipologia],
                [
                    'prescrizione' => $performanceData['prescrizione'] ?? '',
                    'descrizione' => $performanceData['descrizione'] ?? '',
                    'sp_dipartimento' => $departmentKey
                ]
            );

            // Associa la prestazione al dipartimento (se la relazione è molti a molti)
            $prestazione->sp_dipartimento = $department->specializzazione;
            $prestazione->save();

            $prestazione = Prestazione::where('tipologia', $tipologia)->first();

            if (!$prestazione) {
                // Performance not found
                continue;
            }

            $prestazione->giorni()->delete();
            $prestazione->orari()->delete();

            // Add the specified days and hours
            foreach ($performanceData['giorni'] ?? [] as $giorno) {
                $prestazione->giorni()->create([
                    'dipartimento_id' => $department->id,
                    'giorno' => $giorno,
                ]);
            }

            foreach ($performanceData['orari'] ?? [] as $ora) {
                $exists = Orario::where('valore_orario', $ora)->exists();
                if (!$exists) {
                    Orario::create(['valore_orario' => $ora]);
                }
                $prestazione->orari()->create([
                    'orario' => $ora
                ]);
            }
        }
    }
}
