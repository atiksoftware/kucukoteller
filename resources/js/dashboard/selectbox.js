import slugify from 'slugify';

(()=>{
 
    // create a class
    class SelectBox {
        constructor(selectbox){
            this.selectbox = selectbox;
            this.init();
            this.slugify_options = {
                replacement: '',
                lower: true,
                remove: /[*+~.()'"!:@]/g,
                locale: 'tr'
            };
        }

        init(){
            this.input_value = this.selectbox.querySelector("[data-input-value]");
            this.view_container = this.selectbox.querySelector("[data-view-container]");
            this.view_text = this.selectbox.querySelector("[data-view-text]");

            this.option_container = this.selectbox.querySelector("[data-option-container]");
            this.input_filter = this.selectbox.querySelector("[data-input-filter]");
            this.no_result = this.selectbox.querySelector("[data-no-result]");

            this.option_list = this.selectbox.querySelector("[data-option-list]");
            this.option_items = this.selectbox.querySelectorAll("[data-option-item]");

            this.searchable = this.selectbox.getAttribute("data-searchable") == "1";

            this.view_container.addEventListener("click", ()=>{
                this.toggleOptionList()
                setTimeout(() => {
                    document.addEventListener('click', (e) => {   
                        if(!this.selectbox.contains(e.target)){
                            this.hideOptionList()
                        } 
                    },{once : true});
                }, 1);
            });  
            this.option_items.forEach(item => {
                item.addEventListener("click", ()=>{
                    this.selectOption(item);
                    this.hideOptionList();
                }) 
            })
            if(this.input_filter != null){
                this.input_filter.addEventListener("input", ()=>{
                    this.filterOption();
                })
            }
        } 
        toggleOptionList(){
            if(this.option_container.classList.contains("hidden")){
                this.showOptionList();
            }
            else{
                this.hideOptionList();
            }
        }
        showOptionList(){ 
            this.option_container.classList.remove("hidden");
            this.clearInputFilter()
            this.focusInputFilter()
            this.repositionOptionContainer()
        }
        hideOptionList(){
            this.option_container.classList.add("hidden");
        }
        selectOption(option_item){  
            this.input_value.value = option_item.getAttribute("data-value");
            this.view_text.innerHTML = option_item.getAttribute("data-text");
        }
        clearInputFilter(){
            if(this.input_filter != null){
                this.input_filter.value = "";
            }
        }
        focusInputFilter(){
            if(this.input_filter != null){
                this.input_filter.focus();
            }
        }
        filterOption(){
            if(!this.searchable){
                return;
            }
            if(this.input_filter == null){ 
                return;
            }
            let filter_value = slugify(this.input_filter.value, this.slugify_options); 
            let count = 0;
            this.option_items.forEach(item => {
                let item_value = slugify(item.getAttribute("data-text"), this.slugify_options);
                if(item_value.includes(filter_value)){
                    item.classList.remove("hidden");
                    count++;
                }
                else{
                    item.classList.add("hidden");
                }
            })
            if(count == 0){
                this.no_result.classList.remove("hidden");
            }
            else{
                this.no_result.classList.add("hidden");
            } 
        }
        repositionOptionContainer(){
            let window_height = window.innerHeight;
            let selectbox_rect = this.selectbox.getBoundingClientRect();
            let container_rect = this.option_container.getBoundingClientRect();
            let is_upside = false;
            if(selectbox_rect.bottom - 50 + container_rect.height > window_height){
                is_upside = true;
            }
            if(is_upside){
                this.option_container.classList.remove("top-full");
                this.option_container.classList.add("bottom-full");
            }
            else{ 
                this.option_container.classList.remove("bottom-full");
                this.option_container.classList.add("top-full");
            }

         
        }
    }

    let selectboxes = document.querySelectorAll('[data-selectbox]');
    selectboxes.forEach(selectbox => {
        new SelectBox(selectbox);
    })

})();


