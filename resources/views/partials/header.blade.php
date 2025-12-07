 <header class="bg-white">
     <nav aria-label="Global" class="mx-auto flex max-w-7xl items-center justify-between p-4 lg:px-6">
         <div class="flex lg:flex-1">
             <a href="#" class="-m-1.5 p-1.5">
                 <h2 class="text-xl text-black font-bold"> SGHRL</h2>
                 <span class="sr-only">Your Company</span>
                 <!-- <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="" class="h-8 w-auto" /> -->
             </a>
         </div>
         <div class="flex lg:hidden">
             <button type="button" command="show-modal" commandfor="mobile-menu" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-400">
                 <span class="sr-only">Open main menu</span>
                 <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                     <path d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" stroke-linecap="round" stroke-linejoin="round" />
                 </svg>
             </button>
         </div>
         <el-popover-group class="hidden lg:flex lg:gap-x-12">
             <a href="#" class="text-sm/6 font-semibold text-black">Jobs</a>
             <a href="#" class="text-sm/6 font-semibold text-black">Companies</a>
         </el-popover-group>
         <div class="hidden lg:flex lg:flex-1 lg:justify-end gap-4">
             <a href="#" class="text-sm/6 font-semibold text-black border border-1 px-4 py-2 rounded-3xl">Log in</a>
             <a href="#" class="text-sm/6 font-semibold text-white bg-orange-400 border-orange-400 border border-1 px-4 py-2 rounded-3xl">Register</a>
         </div>
     </nav>
     <el-dialog>
         <dialog id="mobile-menu" class="backdrop:bg-transparent lg:hidden">
             <div tabindex="0" class="fixed inset-0 focus:outline-none">
                 <el-dialog-panel class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-gray-900 p-6 sm:max-w-sm sm:ring-1 sm:ring-gray-100/10">
                     <div class="flex items-center justify-between">
                         <a href="#" class="-m-1.5 p-1.5">
                             <span class="sr-only">Your Company</span>
                             <img src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="" class="h-8 w-auto" />
                         </a>
                         <button type="button" command="close" commandfor="mobile-menu" class="-m-2.5 rounded-md p-2.5 text-gray-400">
                             <span class="sr-only">Close menu</span>
                             <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                 <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                             </svg>
                         </button>
                     </div>
                     <div class="mt-6 flow-root">
                         <div class="-my-6 divide-y divide-white/10">
                             <div class="space-y-2 py-6">
                                 <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-black hover:bg-white/5">Jobs</a>
                                 <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-black hover:bg-white/5">Companies</a>
                             </div>
                             <div class="py-6">
                                 <a href="#" class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-black hover:bg-white/5">Log in</a>
                             </div>
                         </div>
                     </div>
                 </el-dialog-panel>
             </div>
         </dialog>
     </el-dialog>
 </header>