<h1>Modifica Corso</h1>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color:red">{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form method="POST" action="{{ route('courses.update', $course->id)}}">
    @csrf
    @method('PUT')

    <label>Titolo</label>
    <input type="text" name="title" value="{{ old ('title', $course->title)}}">
    <br>
    <label>Descrizione</label>
    <textarea name="description">{{ old ('description', $course->description)}}</textarea>
    <br>
    <label>Durata (in ore)</label>
    <input type="number" name="duration_hours" value="{{ old ('duration_hours', $course->duration_hours)}}">
    <br>
    <label>Requisiti</label>
    <textarea name="requirements">{{ old ('requirements', $course->requirements)}}</textarea>
    <br>
    <label>Stato</label>
    <input type="text" name="status" value="{{ old ('status', $course->status)}}">
    <br>
    <label>Data inizio</label>
    <input type="date" name="start_date" value="{{ old ('start_date', $course->start_date)}}">
    <br>
    <label>Data fine</label>
    <input type="date" name="end_date" value="{{ old ('end_date', $course->end_date)}}">
    <br>
    <label>Lingua</label>
    <input type="text" name="language" value="{{ old ('language', $course->language)}}">
    <br>
    <label>Modalità</label>
    <input type="text" name="delivery_mode" value="{{ old ('delivery_mode', $course->delivery_mode)}}">
    <br>
    <label>Categoria</label>
    <select name="category_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" 
            {{ $category->id == (old('category_id', $course->category_id) == $category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
    <br>
    <label>Livello</label>
    <select name="level_id">
        @foreach ($levels as $level)
            <option value="{{ $level->id }}" 
            {{ $level->id == (old('level_id', $course->level_id) == $level->id) ? 'selected' : '' }}>
                {{ $level->name }}
            </option>
        @endforeach
    </select>
    <br>
    <label>Insegnante</label>
    <select name="teacher_id">
        @foreach ($teachers as $teacher)
            <option value="{{ $teacher->id }}"            
            {{ $teacher->id == (old('teacher_id', $course->teacher_id) == $teacher->id) ? 'selected' : '' }}>
                {{ $teacher->name }} {{ $teacher->surname }} 
            </option>
        @endforeach
    </select>
    <br>
    <button type="submit">Aggiorna Corso</button>
</form>   
