
  import Swiper,{Mousewheel} from 'swiper';
  import 'swiper/css';

(()=>{ 

    
    document.querySelectorAll("[data-tabs]").forEach(container => {  
        // get container's prev sibling
        let prevEl = container.previousElementSibling;
        // get container's next sibling
        let nextEl = container.nextElementSibling; 

        const swiper = new Swiper(container, { 
            slidesPerView: "auto",
            spaceBetween: 0,
            mousewheel: true,
            freeMode: true,
            navigation: {
                nextEl: prevEl,
                prevEl: nextEl,
            },
            modules : [Mousewheel],
            breakpoints : {
                // 1400 : {
                //     spaceBetween: 10,
                // },
                // 1600 : {
                //     spaceBetween: 30,
                // }
            }
        });
        prevEl.addEventListener('click', () => {
            swiper.slidePrev();
        })
        nextEl.addEventListener('click', () => {
            swiper.slideNext();
        }) 

        // get active tab
        let activeTab = container.querySelector('[active-tab]');
        // get active tab's data-tab-index
        let activeTabIndex = parseInt(activeTab.getAttribute('data-tab-index')); 
        // swiper slide to active tab
        swiper.slideTo(activeTabIndex);





    });

})();


