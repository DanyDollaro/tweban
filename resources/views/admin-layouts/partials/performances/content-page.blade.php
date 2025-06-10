<!-- Used to store the current performance type -->
<input type="hidden" id="hidden-performance-type">

<div id="calendar" style="flex: 1; margin-bottom: 20px;"></div>

<div style="width: 100%; height: 400px; margin-bottom: 20px;">
    <select multiple id="appointments-select" style="width: 100%; height: 100%;" onchange="appointmentSelectOnChange"></select>
</div>

<input type="datetime-local" id="appointment-datetime" name="appointment-datetime" style="margin-bottom: 20px">


