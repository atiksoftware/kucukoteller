import Sortable from 'sortablejs/modular/sortable.complete.esm.js';

(()=>{ 

    
    document.querySelectorAll("[data-rooms]").forEach(container => {  
        let sortable = new Sortable(container, {
            handle: '[sortable-handler]',
            ghostClass : 'bg-blue-50',
            filter: "[data-static]",
            onMove: function (e) {  
                return !e.related.hasAttribute('data-static');
            }
        })

    });

})();


