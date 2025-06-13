<div class="content">
    <form id="department-form" method="POST" action="{{ route('admin.departmentAction') }}">

        @csrf

        <h1 id="content-title"></h1>

        <!-- Used to store the department data as JSON on sumbit -->
        <input type="hidden" id="department_data" name="department_data">

        <!-- Used to store the department identifier -->
        <input type="hidden" id="current_department" name="department_key"></input>

        <!-- Specializzazione -->
        <label class="label-text">Specializzazione</label><br>
        <input type="text" id="content-specialization"><br><br>

        <!-- Perstazioni disponibili -->
        <label class="label-text" id="bok-1">Prestazioni disponibili</label><br>
        <select id="content-available-performances" multiple size="10"></select>
        <br><br>

        <!-- Prestazioni associate -->
        <label class="label-text" id="bok-2">Prestazioni associate</label><br>
        <select id="content-performances" size="8">
        </select><br><br>

        <!-- Giorni disponibili -->
        <label class="label-text" id="bok-3">Giorni disponibili</label><br>
        <select id="content-days" multiple size="5"></select><br><br>

        <!-- Orario -->
        <label class="label-text" id="bok-4">Orario</label><br>
        <div id="hours-div" style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 10px;">
            @for ($i = 0; $i < 24; $i++)
                <label>
                    <input type="checkbox" name="hours[]" value="{{ $i }}">
                    {{ sprintf('%02d:00', $i) }}
                </label>
            @endfor
        </div><br>

        <button id="modify-button" type="submit" name="action" value="modify">Modifica</button>
        <button id="delete-button" type="submit" name="action" value="delete">Elimina</button>
        <button id="create-button" type="submit" name="action" value="create">Crea</button>

    </form>

    <!-- JS scripts -->
    <script>
        $(document).ready(function () {
            $('#content-performances').on('change', performanceSelectOnChange);

            $('#content-available-performances').on('change', function () {
                availablePerformanceSelectOnChange($(this).val());
            });

            $('#content-days').on('change', updateSelectedDays);

            $('#content-specialization').on('change', contentSpecializationOnChange);

            $('input[name="hours[]"]').on('change', function() {
                updateSelectedHours();
            });
        });
    </script>
</div>
