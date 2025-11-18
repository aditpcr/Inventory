@auth
    <footer class="bg-white border-t border-gray-200/60 ml-0 lg:ml-80 transition-all duration-300 backdrop-blur-lg bg-white/95">
        <div class="max-w-7xl mx-auto py-6 px-6 sm:px-8 lg:px-10">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-3 text-gray-600 mb-4 md:mb-0">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-utensils text-white text-sm"></i>
                    </div>
                    <span class="text-sm font-bold">Restaurant Management System</span>
                </div>
                
                <div class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-8">
                    <span class="text-sm text-gray-500 font-medium">
                        Logged in as: <span class="font-bold text-gray-700 capitalize">{{ Auth::user()->role }}</span>
                    </span>
                    <span class="text-sm text-gray-500 font-medium">
                        &copy; {{ date('Y') }} RestaurantMS. All rights reserved.
                    </span>
                </div>
            </div>
        </div>
    </footer>
@else
    <footer class="bg-white border-t border-gray-200/60 backdrop-blur-lg bg-white/95">
        <div class="max-w-7xl mx-auto py-6 px-6 sm:px-8 lg:px-10">
            <div class="text-center text-gray-600">
                <div class="flex items-center justify-center space-x-3 mb-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-utensils text-white text-sm"></i>
                    </div>
                    <span class="text-sm font-bold">Restaurant Management System</span>
                </div>
                <p class="text-sm font-medium">&copy; {{ date('Y') }} RestaurantMS. All rights reserved.</p>
            </div>
        </div>
    </footer>
@endauth