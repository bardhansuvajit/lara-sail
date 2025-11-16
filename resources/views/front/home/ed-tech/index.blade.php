<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Home') }}">

    <header class="sticky top-0 z-50 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm border-b border-gray-200 dark:border-gray-800">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 rounded-lg bg-primary-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v6l9-5M12 20l-9-5" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-primary-600 dark:text-primary-400">EduPath</span>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-sm font-medium hover:text-primary-500 transition-colors">Home</a>
                    <a href="#" class="text-sm font-medium hover:text-primary-500 transition-colors">Classes</a>
                    <a href="#" class="text-sm font-medium hover:text-primary-500 transition-colors">Subjects</a>
                    <a href="#" class="text-sm font-medium hover:text-primary-500 transition-colors">Question Papers</a>
                    <a href="#" class="text-sm font-medium hover:text-primary-500 transition-colors">Schools</a>
                </nav>

                <!-- Right side buttons -->
                <div class="flex items-center space-x-4">
                    <!-- Theme Toggle -->
                    <button id="theme-toggle" class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                        <svg id="theme-light-icon" class="w-5 h-5 text-gray-800 dark:hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-dark-icon" class="w-5 h-5 text-yellow-500 hidden dark:block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>

                    <!-- Search -->
                    <button class="p-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>

                    <!-- Login/Register -->
                    <div class="hidden md:flex space-x-2">
                        <button class="px-4 py-2 text-sm font-medium rounded-lg border border-primary-500 text-primary-500 hover:bg-primary-50 dark:hover:bg-gray-800 transition-colors">Login</button>
                        <button class="px-4 py-2 text-sm font-medium rounded-lg bg-primary-500 text-white hover:bg-primary-600 transition-colors">Register</button>
                    </div>

                    <!-- Mobile menu button -->
                    <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-200 dark:border-gray-800 pt-4">
                <div class="flex flex-col space-y-4">
                    <a href="#" class="text-sm font-medium hover:text-primary-500 transition-colors">Home</a>
                    <a href="#" class="text-sm font-medium hover:text-primary-500 transition-colors">Classes</a>
                    <a href="#" class="text-sm font-medium hover:text-primary-500 transition-colors">Subjects</a>
                    <a href="#" class="text-sm font-medium hover:text-primary-500 transition-colors">Question Papers</a>
                    <a href="#" class="text-sm font-medium hover:text-primary-500 transition-colors">Schools</a>
                    <div class="flex space-x-2 pt-2">
                        <button class="flex-1 px-4 py-2 text-sm font-medium rounded-lg border border-primary-500 text-primary-500 hover:bg-primary-50 dark:hover:bg-gray-800 transition-colors">Login</button>
                        <button class="flex-1 px-4 py-2 text-sm font-medium rounded-lg bg-primary-500 text-white hover:bg-primary-600 transition-colors">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>

    <!-- Hero Section -->
    <section class="hero-gradient text-white py-16 md:py-24">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">Master Your Exams with EduPath</h1>
                    <p class="text-lg md:text-xl mb-6 opacity-90">India's most comprehensive learning platform for Classes 9-12 with specialized content for WBBSE & WBCHSE boards</p>
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <button class="px-6 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors flex items-center justify-center">
                            <span>Explore Question Papers</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </button>
                        <button class="px-6 py-3 bg-transparent border-2 border-white text-white font-semibold rounded-lg hover:bg-white/10 transition-colors flex items-center justify-center">
                            <span>Watch Demo</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="md:w-1/2 flex justify-center">
                    <div class="relative w-full max-w-md">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 shadow-xl">
                            <img src="https://images.pexels.com/photos/5212345/pexels-photo-5212345.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Student studying" class="rounded-xl w-full h-64 object-cover">
                        </div>
                        <div class="absolute -bottom-6 -left-6 bg-white dark:bg-gray-800 rounded-xl shadow-lg p-4 w-3/4">
                            <div class="flex items-center">
                                <div class="w-12 h-12 rounded-lg bg-primary-100 dark:bg-primary-900 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-sm font-semibold text-gray-800 dark:text-white">10,000+ Question Papers</h3>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">From previous years</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Why Choose EduPath?</h2>
                <p class="text-sm max-w-2xl mx-auto text-gray-600 dark:text-gray-400">We provide specialized educational content tailored for Indian students and boards</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Feature 1 -->
                <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm card-hover">
                    <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Structured Curriculum</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400">Organized content for Classes 9-12 following WBBSE & WBCHSE syllabi with chapter-wise breakdown.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm card-hover">
                    <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Extensive Question Bank</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400">Access to 10,000+ previous year question papers with detailed solutions and answer keys.</p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm card-hover">
                    <div class="w-12 h-12 rounded-lg bg-purple-100 dark:bg-purple-900 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Expert Educators</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400">Learn from experienced teachers specializing in board exam preparation and concept clarity.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm card-hover">
                    <div class="w-12 h-12 rounded-lg bg-orange-100 dark:bg-orange-900 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600 dark:text-orange-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Performance Analytics</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400">Track your progress with detailed analytics and personalized recommendations for improvement.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Classes Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Choose Your Class</h2>
                <p class="text-sm max-w-2xl mx-auto text-gray-600 dark:text-gray-400">Specialized content for each academic level with board-specific syllabus</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Class 9 -->
                <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm card-hover text-center">
                    <div class="w-16 h-16 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold text-primary-600 dark:text-primary-400">9</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Class 9</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-4">Foundation building for board exams</p>
                    <button class="text-xs text-primary-500 font-medium hover:text-primary-600 transition-colors">Explore Subjects →</button>
                </div>

                <!-- Class 10 -->
                <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm card-hover text-center border-2 border-primary-500 relative">
                    <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                        <span class="bg-primary-500 text-white text-xs px-3 py-1 rounded-full">Most Popular</span>
                    </div>
                    <div class="w-16 h-16 rounded-full bg-primary-500 flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold text-white">10</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Class 10</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-4">Madhyamik preparation</p>
                    <button class="text-xs text-primary-500 font-medium hover:text-primary-600 transition-colors">Explore Subjects →</button>
                </div>

                <!-- Class 11 -->
                <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm card-hover text-center">
                    <div class="w-16 h-16 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold text-primary-600 dark:text-primary-400">11</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Class 11</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-4">Higher Secondary foundation</p>
                    <button class="text-xs text-primary-500 font-medium hover:text-primary-600 transition-colors">Explore Subjects →</button>
                </div>

                <!-- Class 12 -->
                <div class="bg-white dark:bg-gray-900 rounded-xl p-6 shadow-sm card-hover text-center">
                    <div class="w-16 h-16 rounded-full bg-primary-100 dark:bg-primary-900 flex items-center justify-center mx-auto mb-4">
                        <span class="text-xl font-bold text-primary-600 dark:text-primary-400">12</span>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Class 12</h3>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-4">Higher Secondary preparation</p>
                    <button class="text-xs text-primary-500 font-medium hover:text-primary-600 transition-colors">Explore Subjects →</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Question Papers Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-12">
                <div>
                    <h2 class="text-2xl md:text-3xl font-bold mb-4">Question Papers Collection</h2>
                    <p class="text-sm max-w-2xl text-gray-600 dark:text-gray-400">Access previous years' question papers with solutions for effective exam preparation</p>
                </div>
                <button class="mt-4 md:mt-0 px-6 py-3 bg-primary-500 text-white font-medium rounded-lg hover:bg-primary-600 transition-colors flex items-center">
                    <span>View All Papers</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Paper 1 -->
                <div class="bg-white dark:bg-gray-900 rounded-xl overflow-hidden shadow-sm card-hover">
                    <div class="h-40 bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold">Mathematics 2023</h3>
                            <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs px-2 py-1 rounded-full">WBBSE</span>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-4">Class 10 Madhyamik Mathematics question paper with detailed solutions</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">120 questions</span>
                            <button class="text-xs text-primary-500 font-medium hover:text-primary-600 transition-colors">View Paper →</button>
                        </div>
                    </div>
                </div>

                <!-- Paper 2 -->
                <div class="bg-white dark:bg-gray-900 rounded-xl overflow-hidden shadow-sm card-hover">
                    <div class="h-40 bg-gradient-to-r from-green-500 to-teal-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold">Physical Science 2022</h3>
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs px-2 py-1 rounded-full">WBCHSE</span>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-4">Class 12 Higher Secondary Physical Science question paper</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">95 questions</span>
                            <button class="text-xs text-primary-500 font-medium hover:text-primary-600 transition-colors">View Paper →</button>
                        </div>
                    </div>
                </div>

                <!-- Paper 3 -->
                <div class="bg-white dark:bg-gray-900 rounded-xl overflow-hidden shadow-sm card-hover">
                    <div class="h-40 bg-gradient-to-r from-purple-500 to-pink-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-white opacity-80" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="text-lg font-semibold">Bengali 2021</h3>
                            <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs px-2 py-1 rounded-full">WBBSE</span>
                        </div>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mb-4">Class 10 Madhyamik Bengali question paper with model answers</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-gray-500 dark:text-gray-400">80 questions</span>
                            <button class="text-xs text-primary-500 font-medium hover:text-primary-600 transition-colors">View Paper →</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Boards Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">Supported Education Boards</h2>
                <p class="text-sm max-w-2xl mx-auto text-gray-600 dark:text-gray-400">We provide specialized content for West Bengal's primary education boards</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- WBBSE -->
                <div class="bg-white dark:bg-gray-900 rounded-xl p-8 shadow-sm card-hover">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-lg bg-green-100 dark:bg-green-900 flex items-center justify-center">
                            <span class="text-xl font-bold text-green-600 dark:text-green-400">WB</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold">WBBSE</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400">West Bengal Board of Secondary Education</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-6">Complete curriculum coverage for Madhyamik (Class 10) examinations with previous 10 years question papers.</p>
                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Class 9 & 10 Syllabus</span>
                    </div>
                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>10+ Years Question Papers</span>
                    </div>
                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Chapter-wise Solutions</span>
                    </div>
                </div>

                <!-- WBCHSE -->
                <div class="bg-white dark:bg-gray-900 rounded-xl p-8 shadow-sm card-hover">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 rounded-lg bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <span class="text-xl font-bold text-blue-600 dark:text-blue-400">WB</span>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-xl font-bold">WBCHSE</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-400">West Bengal Council of Higher Secondary Education</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-6">Comprehensive resources for Higher Secondary (Class 11 & 12) with subject-specific question banks.</p>
                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Class 11 & 12 Syllabus</span>
                    </div>
                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Stream-wise Content</span>
                    </div>
                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Model Test Papers</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">Start Your Learning Journey Today</h2>
            <p class="text-sm max-w-2xl mx-auto mb-8 opacity-90">Join thousands of students who have improved their exam performance with EduPath</p>
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <button class="px-6 py-3 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors">Create Free Account</button>
                <button class="px-6 py-3 bg-transparent border-2 border-white text-white font-semibold rounded-lg hover:bg-white/10 transition-colors">Talk to Our Experts</button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-primary-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">EduPath</span>
                    </div>
                    <p class="text-xs mb-4">India's premier learning platform for Classes 9-12 with specialized content for WBBSE & WBCHSE boards.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-sm font-semibold text-white mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#" class="hover:text-white transition-colors">Home</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Courses</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Question Papers</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Classes -->
                <div>
                    <h3 class="text-sm font-semibold text-white mb-4">Classes</h3>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#" class="hover:text-white transition-colors">Class 9</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Class 10</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Class 11</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Class 12</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div>
                    <h3 class="text-sm font-semibold text-white mb-4">Contact Us</h3>
                    <ul class="space-y-2 text-xs">
                        <li class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Kolkata, West Bengal, India</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>+91 98765 43210</span>
                        </li>
                        <li class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>support@edupath.com</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-xs text-center">
                <p>© 2023 EduPath. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- <script>
        // Theme Toggle
        const themeToggle = document.getElementById('theme-toggle');
        const themeLightIcon = document.getElementById('theme-light-icon');
        const themeDarkIcon = document.getElementById('theme-dark-icon');

        themeToggle.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
            themeLightIcon.classList.toggle('hidden');
            themeDarkIcon.classList.toggle('hidden');
        });

        // Mobile Menu Toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script> --}}

</x-guest-layout>