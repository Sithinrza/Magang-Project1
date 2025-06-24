<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Monitoring</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-blue-100">


    <div class="container mx-auto p-4 sm:p-6 lg:p-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-6" role="alert">
                <strong class="font-bold">Sukses!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        <h1 class="text-2xl p-4 font-bold text-gray-800 mb-6 text-center">Project Monitoring</h1>

        <div class="mb-4">
            <a href="{{ route('projects.create') }}" class="bg-blue-500 hover:bg-babyblue text-white font-bold py-2 px-4 rounded">
                + Tambah Project
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Project Name</th>
                        <th scope="col" class="px-6 py-3">Client</th>
                        <th scope="col" class="px-6 py-3">Project Leader</th>
                        <th scope="col" class="px-6 py-3">Start Date</th>
                        <th scope="col" class="px-6 py-3">End Date</th>
                        <th scope="col" class="px-6 py-3">Progress</th>
                        <th scope="col" class="px-6 py-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                    <tr class="bg-white border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-semibold text-gray-900">
                            {{ $project->project_name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $project->client_name }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                @if ($project->photo)
                                    <img class="w-10 h-10 rounded-full mr-4" src="{{ asset('storage/' . $project->photo) }}" alt="Photo">
                                @else
                                     <img class="w-10 h-10 rounded-full mr-4" src="https://via.placeholder.com/40" alt="No Photo">
                                @endif
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $project->project_leader }}</div>
                                    <div class="text-xs text-gray-500">{{ $project->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($project->end_date)->format('d M Y') }}
                        </td>
                        <td class="px-6 py-4">
                             <div class="flex items-center">
                                <div class="w-full bg-gray-200 rounded-full h-2.5 mr-2">
                                    @if($project->progress == 100)
                                        <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ $project->progress }}%"></div>
                                    @else
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $project->progress }}%"></div>
                                    @endif
                                </div>
                                <span class="text-xs font-semibold">{{ $project->progress }}%</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('projects.edit', $project->id) }}" class="p-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 bg-red-500 text-white rounded-md hover:bg-red-600">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Tidak ada data project.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
