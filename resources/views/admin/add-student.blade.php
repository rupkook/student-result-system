@extends('layouts.admin')

@section('title', 'Add New Student - Admin Panel')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/students.css') }}">
@endsection

@section('content')
<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg border-r border-gray-200">
        <div class="p-6">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-red-500 rounded-lg flex items-center justify-center">
                    <i class="fas fa-user-shield text-white"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800">Admin Panel</h2>
            </div>
        </div>
        
        <nav class="mt-6">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-600 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                <i class="fas fa-home w-5 h-5 mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.students') }}" class="sidebar-item flex items-center px-6 py-3 text-red-600 bg-red-50 border-l-4 border-red-600 transition-all duration-200">
                <i class="fas fa-user-graduate w-5 h-5 mr-3"></i>
                Manage Students
            </a>
            <a href="{{ route('admin.results') }}" class="sidebar-item flex items-center px-6 py-3 text-gray-600 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                <i class="fas fa-chart-line w-5 h-5 mr-3"></i>
                Manage Results
            </a>
            <a href="{{ route('logout') }}" class="sidebar-item flex items-center px-6 py-3 text-red-600 hover:text-red-700 mt-8 transition-all duration-200">
                <i class="fas fa-sign-out-alt w-5 h-5 mr-3"></i>
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
                    <a href="{{ route('admin.students') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-50">
                        <i class="fas fa-arrow-left w-4 h-4 mr-2"></i>
                        Back to Students
                    </a>
                    <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-shield text-white text-sm"></i>
                    </div>
                </div>
            </div>
        </header>

        <!-- Success Message -->
        @if(session('success'))
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 p-4 m-4 rounded-lg shadow-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle w-6 h-6 mr-3 text-green-600"></i>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-gradient-to-br from-gray-50 to-gray-100 p-6">
            <div class="max-w-5xl mx-auto">
                <div class="bg-white rounded-2xl shadow-2xl p-8 border border-gray-100">
                    <!-- Form Header -->
                    <div class="mb-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full mb-4">
                            <i class="fas fa-user-plus text-white text-2xl"></i>
                        </div>
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">Add New Student</h1>
                        <p class="text-gray-600">Fill in the information below to register a new student</p>
                    </div>

                    <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Personal Information -->
                        <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                            <div class="flex items-center mb-6 pb-3 border-b-2 border-gray-200">
                                <div class="text-xl font-bold text-gray-800 flex items-center">
                                    <i class="fas fa-user text-blue-600"></i>
                                    Personal Information
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-user w-4 h-4 mr-2 text-gray-500"></i>
                                        First Name <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" name="first_name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400"
                                           value="{{ old('first_name') }}"
                                           placeholder="Enter first name">
                                    @error('first_name')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-user w-4 h-4 mr-2 text-gray-500"></i>
                                        Last Name <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" name="last_name" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400"
                                           value="{{ old('last_name') }}"
                                           placeholder="Enter last name">
                                    @error('last_name')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-envelope w-4 h-4 mr-2 text-gray-500"></i>
                                        Email <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="email" name="email" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400"
                                           value="{{ old('email') }}"
                                           placeholder="student@example.com">
                                    @error('email')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-phone w-4 h-4 mr-2 text-gray-500"></i>
                                        Phone
                                    </label>
                                    <input type="text" name="phone"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400"
                                           value="{{ old('phone') }}"
                                           placeholder="+880 1XXX XXXXXX">
                                    @error('phone')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-calendar w-4 h-4 mr-2 text-gray-500"></i>
                                        Date of Birth <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="date" name="date_of_birth" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400"
                                           value="{{ old('date_of_birth') }}">
                                    @error('date_of_birth')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-venus-mars w-4 h-4 mr-2 text-gray-500"></i>
                                        Gender <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <select name="gender" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-calendar-check w-4 h-4 mr-2 text-gray-500"></i>
                                        Admission Date <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="date" name="admission_date" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400"
                                           value="{{ old('admission_date', date('Y-m-d')) }}">
                                    @error('admission_date')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <!-- Empty cell to maintain grid layout -->
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                            <div class="flex items-center mb-6 pb-3 border-b-2 border-gray-200">
                                <div class="text-xl font-bold text-gray-800 flex items-center">
                                    <i class="fas fa-home text-green-600"></i>
                                    Address Information
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-map-marker-alt w-4 h-4 mr-2 text-gray-500"></i>
                                        Address <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <textarea name="address" required rows="3"
                                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400"
                                              placeholder="Enter complete address">{{ old('address') }}</textarea>
                                    @error('address')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-city w-4 h-4 mr-2 text-gray-500"></i>
                                        City <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" name="city" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400"
                                           value="{{ old('city') }}"
                                           placeholder="Enter city name">
                                    @error('city')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-map w-4 h-4 mr-2 text-gray-500"></i>
                                        Division <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <select name="division" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400">
                                        <option value="">Select Division</option>
                                        <option value="Barishal" {{ old('division') == 'Barishal' ? 'selected' : '' }}>Barishal</option>
                                        <option value="Chattogram" {{ old('division') == 'Chattogram' ? 'selected' : '' }}>Chattogram</option>
                                        <option value="Dhaka" {{ old('division') == 'Dhaka' ? 'selected' : '' }}>Dhaka</option>
                                        <option value="Khulna" {{ old('division') == 'Khulna' ? 'selected' : '' }}>Khulna</option>
                                        <option value="Mymensingh" {{ old('division') == 'Mymensingh' ? 'selected' : '' }}>Mymensingh</option>
                                        <option value="Rajshahi" {{ old('division') == 'Rajshahi' ? 'selected' : '' }}>Rajshahi</option>
                                        <option value="Rangpur" {{ old('division') == 'Rangpur' ? 'selected' : '' }}>Rangpur</option>
                                        <option value="Sylhet" {{ old('division') == 'Sylhet' ? 'selected' : '' }}>Sylhet</option>
                                    </select>
                                    @error('division')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-mail-bulk w-4 h-4 mr-2 text-gray-500"></i>
                                        Zip Code <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="text" name="zip_code" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400"
                                           value="{{ old('zip_code') }}"
                                           placeholder="Enter zip code">
                                    @error('zip_code')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-globe-asia w-4 h-4 mr-2 text-gray-500"></i>
                                        Country <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <select name="country" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400">
                                        <option value="Bangladesh" {{ old('country') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                    </select>
                                    @error('country')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Academic Information -->
                        <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                            <div class="flex items-center mb-6 pb-3 border-b-2 border-gray-200">
                                <div class="text-xl font-bold text-gray-800 flex items-center">
                                    <i class="fas fa-graduation-cap text-purple-600"></i>
                                    Academic Information
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-book w-4 h-4 mr-2 text-gray-500"></i>
                                        Course <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <select name="course" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400">
                                        <option value="">Select Course</option>
                                        <option value="MERN Stack" {{ old('course') == 'MERN Stack' ? 'selected' : '' }}>MERN Stack</option>
                                        <option value="Web App Dev" {{ old('course') == 'Web App Dev' ? 'selected' : '' }}>Web App Dev</option>
                                        <option value="UI/UX" {{ old('course') == 'UI/UX' ? 'selected' : '' }}>UI/UX</option>
                                        <option value="Python" {{ old('course') == 'Python' ? 'selected' : '' }}>Python</option>
                                        <option value="Graphic Design" {{ old('course') == 'Graphic Design' ? 'selected' : '' }}>Graphic Design</option>
                                        <option value="Motion Design" {{ old('course') == 'Motion Design' ? 'selected' : '' }}>Motion Design</option>
                                        <option value="Video Editing" {{ old('course') == 'Video Editing' ? 'selected' : '' }}>Video Editing</option>
                                        <option value="Digital Marketing" {{ old('course') == 'Digital Marketing' ? 'selected' : '' }}>Digital Marketing</option>
                                        <option value="Cybersecurity" {{ old('course') == 'Cybersecurity' ? 'selected' : '' }}>Cybersecurity</option>
                                        <option value="Data Science" {{ old('course') == 'Data Science' ? 'selected' : '' }}>Data Science</option>
                                        <option value="Networking" {{ old('course') == 'Networking' ? 'selected' : '' }}>Networking</option>
                                    </select>
                                    @error('course')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-toggle-on w-4 h-4 mr-2 text-gray-500"></i>
                                        Status <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <select name="status" required
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400">
                                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : '' }}>Suspended</option>
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Account Information -->
                        <div class="bg-gradient-to-r from-gray-50 to-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                            <div class="flex items-center mb-6 pb-3 border-b-2 border-gray-200">
                                <div class="text-xl font-bold text-gray-800 flex items-center">
                                    <i class="fas fa-lock text-orange-600"></i>
                                    Account Information
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                        <i class="fas fa-key w-4 h-4 mr-2 text-gray-500"></i>
                                        Password <span class="text-red-500 ml-1">*</span>
                                    </label>
                                    <input type="password" name="password" required
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 focus:shadow-lg focus:border-blue-400"
                                           placeholder="Enter password for new student">
                                    @error('password')
                                        <p class="text-red-500 text-sm mt-1 flex items-center">
                                            <i class="fas fa-exclamation-circle w-4 h-4 mr-1"></i>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex justify-between items-center mt-12 pt-8 border-t-2 border-gray-200">
                            <div class="text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                All fields marked with <span class="text-red-500">*</span> are required
                            </div>
                            <div class="flex space-x-4">
                                <a href="{{ route('admin.students') }}" 
                                   class="bg-white text-gray-700 px-6 py-3 rounded-lg border-2 border-gray-300 hover:bg-gray-50 hover:border-gray-400 shadow-md hover:shadow-lg transition-all duration-200 ease-in-out transform hover:scale-105">
                                    <i class="fas fa-times mr-2"></i>
                                    Cancel
                                </a>
                                <button type="submit" 
                                        class="bg-gradient-to-r from-blue-600 to-blue-700 text-black px-6 py-3 rounded-lg hover:from-blue-700 hover:to-blue-800 shadow-lg hover:shadow-xl transition-all duration-200 ease-in-out transform hover:scale-105">
                                    <i class="fas fa-save mr-2"></i>
                                    Save Student
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
function previewPhoto(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('photo-preview');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <img src="${e.target.result}" class="mx-auto rounded-lg shadow-md" style="max-height: 200px;">
                <p class="text-gray-500 mt-2">Click to change photo</p>
                <p class="text-xs text-gray-400">PNG, JPG, GIF up to 2MB</p>
            `;
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
