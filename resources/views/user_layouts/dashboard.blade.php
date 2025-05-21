<!DOCTYPE html>
<html lang="it">
 <!-- Collegamento al CSS -->
 <link rel="stylesheet" href="{{ asset('css/dash.css') }}">
  
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  
</head>
<body>

   @include('user_layouts.structure.navbar') 

    <div class="welcome">
        <h1>Benvenuto in Area Riservata!</h1>
    </div>

   <div class="dashboard-container">
  
    @include('user_layouts.appuntamento')
    @include('user_layouts.profile')
    </div>

   @include('user_layouts.storico')
    
    
    <div id="success-toast" class="toast">
        <p>Hai effettuato l'accesso con successo.</p>
    </div>

   
    
    



    <script> //fondo pagina
  window.addEventListener('DOMContentLoaded', function () {
    const toast = document.getElementById('success-toast');
    if (toast) {
      toast.classList.add('show');
      setTimeout(() => {
        toast.classList.remove('show');
      }, 1000); // scompare dopo 1 secondo
    }
  });
</script>

</body>
</html>