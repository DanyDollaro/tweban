<div class="content">
    <form method="POST">

        <h1 id="content-title"></h1>

        <!-- Specializzazione -->
        <label class="label-text">Specializzazione</label><br>
        <input type="text" name="specialization" id="content-specialization"><br><br>

        <!-- Prestazione -->
        <label class="label-text">Prestazione</label><br>
        <select id="content-performances" size="8">
        </select><br><br>

        <!-- Giorni disponibili -->
        <label class="label-text">Giorni disponibili</label><br>
        <select id="content-days" multiple size="7"></select><br><br>

        <!-- Orario -->
        <label class="label-text">Orario</label><br>
        <div style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 10px;">
            @for ($i = 0; $i < 24; $i++)
                <label>
                    <input type="checkbox" name="hours[]" value="{{ $i }}">
                    {{ sprintf('%02d:00', $i) }}
                </label>
            @endfor
        </div><br>

        <button type="submit">Modifica</button>
    </form>

    <!-- JS scripts -->
    <script>
        $(document).ready(function () {
            $('#content-performances').on('change', performanceSelectOnChange);
        });
    </script>
</div>
