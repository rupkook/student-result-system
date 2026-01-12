@extends('layouts.admin')

@section('title', 'Add New Student - Admin Panel')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/students.css') }}">
@endsection

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg">
        <div class="p-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Admin Panel</h2>
            </div>
        </div>
        
        <nav class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-red-600">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Dashboard
            </a>
            <a href="{{ route('admin.admin.students') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-red-600">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
                Manage Students
            </a>
            <a href="{{ route('admin.results') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-700 hover:text-red-600">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v6m3-2h6"></path>
                </svg>
                Manage Results
            </a>
            <a href="{{ route('logout') }}" class="sidebar-item flex items-center px-6 py-3 text-red-600 hover:text-red-700 mt-8">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                Logout
            </a>
        </nav>
    </div>

    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Navbar -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="px-6 py-4 flex items-center justify-between">
                <h1 class="text-2xl font-semibold text-gray-800">Add New Student</h1>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('admin.admin.students') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Back to Students
                    </a>
                    <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                        <span class="text-white text-sm font-medium">AD</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Add Student Form -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
            <!-- Add Student Table/Form -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" class="rounded border-gray-300">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Course</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Add Student Form Row -->
                            <tr class="bg-blue-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" class="rounded border-gray-300">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-gray-500">Auto-generated</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.admin.students.store') }}" method="POST" class="flex space-x-2">
                                        @csrf
                                        <input type="text" name="first_name" placeholder="First Name" required
                                               class="form-input px-2 py-1 border border-gray-300 rounded text-sm w-20">
                                        <input type="text" name="last_name" placeholder="Last Name" required
                                               class="form-input px-2 py-1 border border-gray-300 rounded text-sm w-20">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="email" name="email" placeholder="Email" required
                                           class="form-input px-2 py-1 border border-gray-300 rounded text-sm w-32">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select name="department" required class="form-input px-2 py-1 border border-gray-300 rounded text-sm">
                                        <option value="">Select Course</option>
                                        <option value="mernstack">MERN Stack</option>
                                        <option value="Web app development (full-stack)">Web App Dev</option>
                                        <option value="UIUX">UI/UX</option>
                                        <option value="Python Programing">Python</option>
                                        <option value="Graphic Design">Graphic Design</option>
                                        <option value="Motion Design">Motion Design</option>
                                        <option value="Vedio Editing">Video Editing</option>
                                        <option value="Digital Marketing">Digital Marketing</option>
                                        <option value="Cybersecurity">Cybersecurity</option>
                                        <option value="Data Science">Data Science</option>
                                        <option value="Networking">Networking</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <select name="status" class="form-input px-2 py-1 border border-gray-300 rounded text-sm">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="suspended">Suspended</option>
                                    </select>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <input type="password" name="password" placeholder="Password" required
                                           class="form-input px-2 py-1 border border-gray-300 rounded text-sm w-24 mb-1">
                                    <div class="flex space-x-2">
                                        <button type="submit" class="text-green-600 hover:text-green-900">Save</button>
                                        <a href="{{ route('admin.admin.students') }}" class="text-red-600 hover:text-red-900">Cancel</a>
                                    </div>
                                    </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
