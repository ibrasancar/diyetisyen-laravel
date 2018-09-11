<div class="col-md-3">
    <div class="form-group">
        <h2>Arama</h2>
        <hr class="my-4">
    </div>
    <form action="{{ route('diyetisyen') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="ara">Diyetisyen Adı:</label>
            <input type="text" name="ara" id="ara" class="form-control mr-2" value="{{ old('ara') }}" placeholder="Diyetisyen adıyla ara...">
        </div>

        <div class="form-group">
            <label for="diyetisyen_tip">Diyetisyen Tipi:</label>
            <select name="diyetisyen_tip" id="diyetisyen_tip" class="form-control">
                <option value="">Diyetisyen Tipi</option>
                @foreach($tipler as $tip)
                    <option value="{{ $tip->tip }}" {{ old('diyetisyen_tip') == $tip->tip ? 'selected' : '' }}>{{ $tip->tanim }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="sirala">Sırala:</label>
            <select name="sirala" id="sirala" class="form-control">
                <option value="puan" {{ old('sirala') == $sirala ? 'selected' : '' }}>Puana göre sırala</option>
                <option value="ad_soyad" {{ old('sirala') == $sirala ? 'selected' : '' }}>İsme göre sırala</option>
            </select>
        </div>

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" >Gönder</button>
            <a class="btn btn-primary" href="{{ route('diyetisyen') }}">Temizle</a>
        </div>

    </form>
</div>