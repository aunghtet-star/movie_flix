@extends('frontend.layouts.app')
@section('content')
 <div class="absolute inset-0 bg-black/50 backdrop-blur-lg">
     <div class=" mx-auto px-4 pt-28">
         <!-- Movies Header Section -->
         <div class="flex justify-between items-center mb-6">
             <div class="flex items-center">
                 <div class="w-1 h-8 bg-green-500 mr-3"></div>
                 <h2 class="text-3xl font-bold text-cyan-400">Movies</h2>
             </div>
             <button class="bg-green-500 text-white px-3 py-1 rounded text-sm font-bold">SEE ALL</button>
         </div>

         <!-- First Row of Movies -->
         <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
             <!-- Movie 1 -->
             <div>
                 <div class="relative">
                     <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%20%28102%29-ZVCb0sRdSnUnjeRprWLY1cqArlGg7A.png" alt="Kesari Chapter 2" class="w-full h-48 object-cover rounded">
                     <div class="absolute bottom-0 left-0 w-full p-2 bg-gradient-to-t from-black to-transparent">
                         <div class="flex items-center">
                             <i class="fas fa-star text-yellow-400 mr-1"></i>
                             <span class="text-sm">8.2</span>
                         </div>
                     </div>
                 </div>
                 <p class="text-sm mt-1 text-gray-400">Golden Slumber (20...)</p>
             </div>

             <div>
                 <div class="relative">
                     <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%20%28102%29-ZVCb0sRdSnUnjeRprWLY1cqArlGg7A.png" alt="Kesari Chapter 2" class="w-full h-48 object-cover rounded">
                     <div class="absolute bottom-0 left-0 w-full p-2 bg-gradient-to-t from-black to-transparent">
                         <div class="flex items-center">
                             <i class="fas fa-star text-yellow-400 mr-1"></i>
                             <span class="text-sm">8.2</span>
                         </div>
                     </div>
                 </div>
                 <p class="text-sm mt-1 text-gray-400">Golden Slumber (20...)</p>
             </div>

             <div>
                 <div class="relative">
                     <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%20%28102%29-ZVCb0sRdSnUnjeRprWLY1cqArlGg7A.png" alt="Kesari Chapter 2" class="w-full h-48 object-cover rounded">
                     <div class="absolute bottom-0 left-0 w-full p-2 bg-gradient-to-t from-black to-transparent">
                         <div class="flex items-center">
                             <i class="fas fa-star text-yellow-400 mr-1"></i>
                             <span class="text-sm">8.2</span>
                         </div>
                     </div>
                 </div>
                 <p class="text-sm mt-1 text-gray-400">Golden Slumber (20...)</p>
             </div>

             <div>
                 <div class="relative">
                     <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%20%28102%29-ZVCb0sRdSnUnjeRprWLY1cqArlGg7A.png" alt="Kesari Chapter 2" class="w-full h-48 object-cover rounded">
                     <div class="absolute bottom-0 left-0 w-full p-2 bg-gradient-to-t from-black to-transparent">
                         <div class="flex items-center">
                             <i class="fas fa-star text-yellow-400 mr-1"></i>
                             <span class="text-sm">8.2</span>
                         </div>
                     </div>
                 </div>
                 <p class="text-sm mt-1 text-gray-400">Golden Slumber (20...)</p>
             </div>

             <div>
                 <div class="relative">
                     <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/Screenshot%20%28102%29-ZVCb0sRdSnUnjeRprWLY1cqArlGg7A.png" alt="Kesari Chapter 2" class="w-full h-48 object-cover rounded">
                     <div class="absolute bottom-0 left-0 w-full p-2 bg-gradient-to-t from-black to-transparent">
                         <div class="flex items-center">
                             <i class="fas fa-star text-yellow-400 mr-1"></i>
                             <span class="text-sm">8.2</span>
                         </div>
                     </div>
                 </div>
                 <p class="text-sm mt-1 text-gray-400">Golden Slumber (20...)</p>
             </div>



         </div>

 </div>
@endsection
