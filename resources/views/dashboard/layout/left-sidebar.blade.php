<div id="navoverlay" class=" fixed left-0 top-0 bottom-0 w-0 bg-black bg-opacity-30 opacity-0 transition-all md:hidden"></div>
<nav class="fixed left-[-300px] md:left-0 top-0 bottom-0  w-[300px] flex flex-col transition-all bg-white" id="left-sidebar">
    <div class="h-16 border-b flex w-full justify-center items-center border-r">
        <span>{{config('app.name')}}</span>
    </div>
    <div class="flex-1 overflow-hidden overflow-y-auto">

        <div class="py-4">
            <a href="" class="px-6 py-2 flex w-full items-center">
                <div class="mr-4">
                    <img class="w-10 h-10 rounded-full" src="https://fonts.gstatic.com/s/i/productlogos/avatar_anonymous_square/v6/192px.svg" alt="">
                </div>
                <div>
                    <div class="text-sm">{{ auth()->user()->fullname }}</div>
                    <div class="text-xs">{{ auth()->user()->email }}</div>
                </div>
            </a>
        </div>


        <div class="space-y-4">
            @for ($i = 0; $i < 6; $i++)
            <div>
                <div class="px-6 text-sm uppercase">GROUP</div>
                <div>
                    @for ($x = 0; $x < 6; $x++)
                    <a href="" class=" flex w-[284px] rounded-r-full pr-4 bg-red-x50 hover:bg-slate-100">
                        <div class="w-6">

                        </div>
                        <div class="w-8 flex items-center">
                            <x-icon name="home" class="w-5" />
                        </div>
                        <div class="flex-1 py-3 overflow-hidden text-ellipsis">
                            <span>KullanıcılarveizinlerKullanıcılarveizinler</span>
                        </div>
                        <div class="flex items-center ml-4">
                            <span>14</span>
                        </div>
                    </a>
                    @endfor  
                </div>
            </div>
            @endfor 


        </div>

    </div>
</nav>