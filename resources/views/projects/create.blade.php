<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tambah Project Baru</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    .btn-transition {
      transition: all 0.3s ease;
    }
  </style>
</head>
<body class="bg-blue-100 to-white min-h-screen flex items-center justify-center px-4">

  <div class="w-full max-w-5xl bg-white p-8 md:p-10 rounded-3xl shadow-xl ring-1 ring-gray-200">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8">Tambah Project Baru</h1>

    @if ($errors->any())
      <div class="bg-red-50 border border-red-300 text-red-800 px-6 py-4 rounded-xl mb-6">
        <strong class="font-semibold">Oops! Ada kesalahan:</strong>
        <ul class="mt-2 list-disc list-inside text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        {{-- Kolom Kiri --}}
        <div class="space-y-4">
          <div>
            <label for="project_name" class="block text-gray-700 font-medium mb-1">Nama Project</label>
            <input type="text" name="project_name" id="project_name" value="{{ old('project_name') }}" required
              class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-700" />
          </div>

          <div>
            <label for="client_name" class="block text-gray-700 font-medium mb-1">Nama Klien</label>
            <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}" required
              class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-700" />
          </div>

          <div>
            <label for="project_leader" class="block text-gray-700 font-medium mb-1">Nama Project Leader</label>
            <input type="text" name="project_leader" id="project_leader" value="{{ old('project_leader') }}" required
              class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-700" />
          </div>

          <div>
            <label for="email" class="block text-gray-700 font-medium mb-1">Email Project Leader</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required
              class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-700" />
          </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="space-y-4">
          <div>
            <label for="start_date" class="block text-gray-700 font-medium mb-1">Tanggal Mulai</label>
            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" required
              class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-700" />
          </div>

          <div>
            <label for="end_date" class="block text-gray-700 font-medium mb-1">Tanggal Selesai</label>
            <input type="date" name="end_date" id="end_date" value="{{ old('end_date') }}" required
              class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-700" />
          </div>

          <div>
            <label for="progress" class="block text-gray-700 font-medium mb-1">Progress (%)</label>
            <input type="number" name="progress" id="progress" min="0" max="100" value="{{ old('progress', 0) }}" required
              class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-700" />
          </div>

          <div>
            <label for="photo" class="block text-gray-700 font-medium mb-1">Foto Project Leader</label>
            <input type="file" name="photo" id="photo"
              class="block w-full file:bg-blue-400 file:text-white file:font-semibold file:px-4 file:py-2 file:rounded-md file:border-0 file:cursor-pointer hover:file:bg-blue-500 text-sm text-gray-700" />
            <p class="text-xs text-gray-500 mt-1">Opsional. Format: JPG, PNG. Maks: 2MB.</p>
          </div>
        </div>
      </div>

      <div class="pt-6 flex justify-end space-x-4 border-t mt-6">
        <a href="{{ route('projects.index') }}"
          class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-5 rounded-lg btn-transition">
          Batal
        </a>
        <button type="submit"
          class="bg-blue-400 hover:bg-blue-500 text-white font-semibold py-2 px-6 rounded-lg shadow-md btn-transition">
          Simpan Project
        </button>
      </div>
    </form>
  </div>

</body>
</html>
