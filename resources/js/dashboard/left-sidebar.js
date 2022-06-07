// import Scrollbar from 'smooth-scrollbar';

// Scrollbar.init(document.querySelector('#left-sidebar-scrollable'));

(()=>{

    let MD = 768;

    let trigger = document.querySelector('#left-sidebar-trigger');
    let navoverlay = document.querySelector('#navoverlay');
    let sidebar = document.querySelector('#left-sidebar');
    let header = document.querySelector('#header');
    let app = document.querySelector('#app');
    let showing = window.innerWidth > MD;
 

    const hideOnMobile = () => {
        sidebar.classList.add('left-[-300px]')
        sidebar.classList.remove('left-0')
        navoverlay.classList.remove('w-full')
        navoverlay.classList.add('w-0')
        navoverlay.classList.add('opacity-0')
        showing = false;
    }

    const showOnMobile = () => {
        sidebar.classList.add('left-0')
        sidebar.classList.remove('left-[-300px]')
        navoverlay.classList.add('w-full')
        navoverlay.classList.remove('w-0')
        navoverlay.classList.remove('opacity-0')
        showing = true;
    }
    
    const hideOnDesktop = () => {
        sidebar.classList.remove('md:left-0'); 
        header.classList.remove('md:left-[300px]'); 
        app.classList.remove('md:pl-[300px]'); 
        showing = false;
    }
    const showOnDesktop = () => {
        sidebar.classList.add('md:left-0'); 
        header.classList.add('md:left-[300px]'); 
        app.classList.add('md:pl-[300px]'); 
        showing = true;
    }
 
    
    trigger.addEventListener('click', () => {  
        const screen_width = window.innerWidth;
        console.log(showing);
        if(screen_width < MD) {   
            if(showing){ 
                hideOnMobile();
            }
            else{ 
                showOnMobile();
            }
        }
        else { 
            if(showing){
                hideOnDesktop();
            }
            else{
                showOnDesktop();
            }
        }
    });
    navoverlay.addEventListener('click', () => {
        hideOnMobile();
    });


})();


