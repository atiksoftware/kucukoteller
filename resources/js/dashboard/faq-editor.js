import Sortable from 'sortablejs/modular/sortable.complete.esm.js';

(()=>{
    class FaqEditor{
        constructor(editor){
            this.editor = editor;
            this.init();
        }
        decode(text){
            const span = document.createElement('span'); 
            return text
            .replace(/&[#A-Za-z0-9]+;/gi, (entity,position,text)=> {
                span.innerHTML = entity;
                return span.innerText;
            });
        }
        init(){
            this.faqs = this.editor.getAttribute('data-faqs');  
            this.faqs = JSON.parse(this.decode(this.faqs)); 
  
            this.locale_codes = JSON.parse(this.decode(this.editor.getAttribute('data-locale-codes')));
            this.locale_names = JSON.parse(this.decode(this.editor.getAttribute('data-locale-names'))); 
 
 
            this.faq_stub = this.editor.querySelector('[data-faq]').cloneNode(true); 
            this.faq_stub.classList.remove('hidden');
            this.faq_stub.classList.add('flex');

            this.editor.innerHTML = '';

            this.faqs.forEach(faq => {
                this.addFaq(faq);
            })

            // get this.editor's next sibling element
            this.add_button_container = this.editor.nextElementSibling;
            this.add_button_container.classList.remove('hidden');
            this.add_button_container.classList.add('flex');
            this.add_button = this.add_button_container.querySelector('button');
            this.add_button.addEventListener('click', ()=>{
                this.addFaq();
                this.renameAll();
            });

            // get this.editor's pref sibling element
            this.loading_container = this.editor.previousElementSibling;
            this.loading_container.remove();

            let sortable = new Sortable(this.editor, {
                handle: '[sortable-handler]',
            })

            this.renameAll();
        }
        addFaq(faq){
            let faq_el = this.faq_stub.cloneNode(true);
            this.editor.appendChild(faq_el);
            let [locale_wrappers, remove_handler] = this.findElements(faq_el);
             
            if(typeof faq !== 'undefined'){
                locale_wrappers.forEach(locale_wrapper => { 
                    if(typeof faq.question[locale_wrapper.locale_code] !== 'undefined'){
                        locale_wrapper.question_el.value = faq.question[locale_wrapper.locale_code];
                    }
                    if(typeof faq.answer[locale_wrapper.locale_code] !== 'undefined'){
                        locale_wrapper.answer_el.value = faq.answer[locale_wrapper.locale_code];
                    } 
                })
            }

            remove_handler.addEventListener('click', ()=>{
                faq_el.remove();
            })
        }
        findElements(faq_el){
            let locale_wrappers = []; 
            this.locale_codes.forEach(locale_code => {
                let locale_wrapper_el = faq_el.querySelector(`[data-locale-code="${locale_code}"]`);
 
                let question_el = locale_wrapper_el.querySelector('[data-question]'); 
                let answer_el = locale_wrapper_el.querySelector('[data-answer]');
                locale_wrappers.push({
                    locale_code : locale_code,
                    el : locale_wrapper_el,
                    question_el : question_el,
                    answer_el : answer_el,
                })
            })
            let remove_handler = faq_el.querySelector('[remove-handler]');

            return [locale_wrappers,remove_handler];
        }
        renameAll(){
            let faq_els = this.editor.querySelectorAll('[data-faq]');
            faq_els.forEach((faq_el,index)=>{
                let [locale_wrappers, remove_handler] = this.findElements(faq_el);
                locale_wrappers.forEach(locale_wrapper => {
                    locale_wrapper.question_el.setAttribute('name', `lines[${index}][question][${locale_wrapper.locale_code}]`);
                    locale_wrapper.answer_el.setAttribute('name', `lines[${index}][answer][${locale_wrapper.locale_code}]`);
                })
            })
        }
    }

    document.querySelectorAll("[data-faq-editor]").forEach(editor => {  
        new FaqEditor(editor); 
    })


})();


