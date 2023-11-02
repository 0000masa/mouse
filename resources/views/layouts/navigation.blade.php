<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex ">
                <!-- Logo -->
                <a href="/" class="flex items-center">
                    <x-application-logo class="mr-3 h-6 sm:h-9"  />
                 </a>
                
            
                <!-- Navigation Links -->
                <nav class="sm:mr-auto sm:ml-4 sm:py-1 sm:pl-4  sm:border-gray-400	hidden sm:flex flex-wrap items-center text-base justify-between">
                    
                    <div class="space-x-5 font-bold">
                         
                         <a href="/searches" class="mr-2 hover:text-gray-900">マウス検索</a>
                         <a href="/usersearches" class="mr-2 hover:text-gray-900">ユーザー検索</a>
                         <a href="/posts/create" class="mr-2 hover:text-gray-900">投稿</a>
                         <a href="/follow/{{Auth::user()->id}}" class="mr-2 hover:text-gray-900">フォロー中</a>
                        
                    </div>
                   
                </nav>
                
               
               
                
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            
                             @if(!Auth::user()->profile || !Auth::user()->profile->id)
                                <div class="flex items-center">
                                  <div class="w-6 h-6 rounded-full overflow-hidden">
                                    <img src="https://res.cloudinary.com/dphdjsiah/image/upload/v1694299123/lxnxz1woewvsxewxdpg1.png" alt="ユーザーのアイコン" class="w-full h-full object-cover" />
                                  </div>
                                  
                                </div>
                            @elseif(Auth::user()->profile->image_url===null)
                              <div class="flex items-center">
                                  <div class="w-6 h-6 rounded-full overflow-hidden">
                                    <img src="https://res.cloudinary.com/dphdjsiah/image/upload/v1694299123/lxnxz1woewvsxewxdpg1.png" alt="ユーザーのアイコン" class="w-full h-full object-cover" />
                                  </div>
                                
                            </div>
                            @else
                              <div class="flex items-center">
                                  <div class="w-6 h-6 rounded-full overflow-hidden">
                                    <img src="{{Auth::user()->profile->image_url}}" alt="ユーザーのアイコン" class="w-full h-full object-cover" />
                                  </div>
                                  
                              </div>
                            @endif
                            
                             <!-- アイコンと名前の間に隙間を追加 -->
                            <div class="mr-2"></div>
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="'/users/'.Auth::user()->id">
                            {{ __('プロフィール') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('名前変更') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('ログアウト') }}
                            </x-dropdown-link>
                        </form>
                        <form onsubmit="return confirm('本当に削除しますか？')" method="post" action="{{ route('profile.destroy') }}" class="p-6">
                            @csrf
                            @method('delete')
                            <x-danger-button
                            >{{ __('Delete Account') }}</x-danger-button>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{--<x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>--}}
            
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="flex items-center">
                      
                         @if(!Auth::user()->profile || !Auth::user()->profile->id)
                            <div class="flex items-center">
                              <div class="w-6 h-6 rounded-full overflow-hidden">
                                <img src="https://res.cloudinary.com/dphdjsiah/image/upload/v1694299123/lxnxz1woewvsxewxdpg1.png" alt="ユーザーのアイコン" class="w-full h-full object-cover" />
                              </div>
                              
                            </div>
                        @elseif(Auth::user()->profile->image_url===null)
                          <div class="flex items-center">
                              <div class="w-6 h-6 rounded-full overflow-hidden">
                                <img src="https://res.cloudinary.com/dphdjsiah/image/upload/v1694299123/lxnxz1woewvsxewxdpg1.png" alt="ユーザーのアイコン" class="w-full h-full object-cover" />
                              </div>
                            
                        </div>
                        @else
                          <div class="flex items-center">
                              <div class="w-6 h-6 rounded-full overflow-hidden">
                                <img src="{{Auth::user()->profile->image_url}}" alt="ユーザーのアイコン" class="w-full h-full object-cover" />
                              </div>
                              
                          </div>
                        @endif
                   
                    
                    
                    
                   
                       
                 
                    <!-- アイコンと名前の間に隙間を追加 -->
                    <div class="mr-2"></div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                </div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                 <x-responsive-nav-link :href="'/searches'">
                    {{ __('マウス検索') }}
                </x-responsive-nav-link>
                 <x-responsive-nav-link :href="'/usersearches'">
                    {{ __('ユーザー検索') }}
                </x-responsive-nav-link>
                 <x-responsive-nav-link :href="'/posts/create'">
                    {{ __('新規投稿作成') }}
                </x-responsive-nav-link>
                 <x-responsive-nav-link :href="'/follow/'.Auth::user()->id">
                    {{ __('フォロー中') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="'/users/'.Auth::user()->id">
                    {{ __('プロフィール') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('名前変更') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('ログアウト') }}
                    </x-responsive-nav-link>
                </form>
                <form onsubmit="return confirm('本当に削除しますか？')" method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')
                    <x-danger-button
                    >{{ __('Delete Account') }}</x-danger-button>
                </form>
    
                
            </div>
        </div>
    </div>
</nav>
