<x-app-layout>
        <x-slot name="header">
        
        </x-slot>
        <div class="bg-white py-6 sm:py-8 lg:py-12">
            <div class="mx-auto max-w-screen-2xl px-4 md:px-8">
                <div class=" items-center rounded-lg bg-gray-100 p-4 sm:p-8 lg:flex-row lg:justify-between">
                    <div class="mb-4 sm:mb-8 lg:mb-0">
                        <h2 class="text-center text-xl font-bold text-black sm:text-2xl lg:text-center lg:text-3xl">ユーザー名検索</h2>
                    </div>
                    <div class="flex flex-col items-center mt-5">
                        <form action="/usersearches/do" method="GET" class="mb-3 flex w-full max-w-md gap-2">
                        @csrf
                    
                            <input  type="text" name="user" class="bg-gray-white w-full flex-1 rounded border border-gray-300 px-3 py-2 text-gray-800 placeholder-gray-400 outline-none ring-indigo-300 transition duration-100 focus:ring">
                            
                            <button class="inline-block rounded bg-indigo-500 px-8 py-2 text-center text-sm font-semibold text-white outline-none ring-indigo-300 transition duration-100 hover:bg-indigo-600 focus-visible:ring active:bg-indigo-700 md:text-base">検索</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                
        </x-app-layout>