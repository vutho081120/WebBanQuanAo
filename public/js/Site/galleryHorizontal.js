function slide(option) {
    //nen dat ten ro nghia nhu current (slide hien tai)
    //truyen ham chua truyen ham the cha thuong chi dung gallery cha
    /*
    var optionTop = {ele:'#galleryTop', limit: 1, widthNext: -1640, widthEnd: -1600};

    var galleryTop = new slide(optionTop);

    */
    var options = option;
    var current = 0;
    var width = 0;
    var widthEnd = 0;
    var that = this;
    var elem = document.querySelector(options.ele);
    var ele = document.querySelector(options.ele + '> ul');
   
    //console.log(document.querySelectorAll(options.ele + '> ul li').length,'abc',options.ele + '> ul li' );
    
    var slides = document.querySelector(options.ele + ' .dots');
    let len = document.querySelectorAll(options.ele + '> ul li').length;

    let pageCount = parseInt(Math.ceil( len/options.limit ));
    // console.log (pageCount);

    function buildPagination(){ 
        var str = '';
        
        for(let i = 0; i < pageCount; i++){
            if(i == 0){
                str+=` <li data-index="${i+1}" style="background:#FB512A" class="dot"></li>`;
            }else{
                str+=` <li  data-index="${i+1}" class="dot"></li>`;
            }
        }
        
        slides.innerHTML = str;
    }

    buildPagination();

    //do ko boc the cha
    this.btnNext = document.querySelector(option.ele+' '+ option.btnNext);
    this.btnBack = document.querySelector(option.ele+' '+option.btnBack);
    //console.log(elem.querySelector("ul.dot li:nth-child(1)"))
    
    //nen dat ten la width
    //console.log(option);
    this.widthNext = option.widthNext;
    this.widthLech = option.widthLech;
    widthEnd = (-document.querySelector(option.ele+' li:nth-child('+((len-options.limit)+1)+')').offsetLeft)+this.widthLech;
    
    function slideRun(width,old){
        var oldCurrrent = document.querySelector(option.ele+' li.dot:nth-child('+old+')');
        
        if(oldCurrrent){
            oldCurrrent.style.backgroundColor='#C4C4C4';
        }

        var liCurrrent = document.querySelector(option.ele+' li.dot:nth-child('+(current+1)+')');
        
        if(liCurrrent){
            liCurrrent.style.backgroundColor='#FB512A';
        }
        ele.style.transform  = 'translateX('+width+'px)';
    
    }
    
    document.querySelector(option.ele +' .dots').addEventListener('click',function(e){ 
        var dotnum = parseInt(e.target.getAttribute('data-index'))-1;
        
        if(!isNaN(dotnum)){
            let oldcurrent = current+1;
            //phan tu hien tai
            width = that.widthNext*dotnum > widthEnd ? that.widthNext*dotnum : widthEnd;
             //gan lai current
            current = dotnum;
            //gan lai cai current hien tai
            slideRun(width,oldcurrent);
            //console.log(width);
        }
    })
    //nen sep ten cùng nghiệp vụ vào một chỗ dễ kiểm tra.
    //idea khi code cac phan repeat ( lặp) thì ko nên gán hàm tuần tự mà nên focus listener tổng để việc bắt vì nếu có 1,2,3,4...n dot sẽ bị giới hạn.
    // nên bắt theo class vì nếu dùng lại id sẽ bị trùng và bắt đầu phần query selector cha là thẻ gallery là tốt nhất
    this.btnNext.addEventListener('click', function(){
        that.next();
    })
    this.btnBack.addEventListener('click', function(){
        that.back();
    })

    this.next = function() {
        let oldCurrent = current;
        
        if (current > pageCount-2) {
            width = widthEnd;
            slideRun(width,oldCurrent+1);
            // ele.style.transform  = 'translateX('+width+'px)';
            // that.btnNext.style.backgroundColor = '#5A5A5A';
            // that.btnBack.style.backgroundColor = '#FB6C27';
        }
        else {
            current++;
            width = that.widthNext*current > widthEnd ? that.widthNext*current : widthEnd;
            slideRun(width,oldCurrent+1);
            // ele.style.transform  = 'translateX('+width+'px)';
            // that.btnNext.style.backgroundColor = '#FB6C27';
            // that.btnBack.style.backgroundColor = '#FB6C27';
        }
    }

    this.back = function() {
        let oldCurrent = current;
        
        if (current < 1) {
            width = 0;
            // ele.style.transform  = 'translateX('+width+'px)';
            // that.btnNext.style.backgroundColor = '#FB6C27';
            // that.btnBack.style.backgroundColor = '#5A5A5A';
        }
        else {
            current--;
            width = that.widthNext*current > widthEnd ? that.widthNext*current : widthEnd;
            slideRun(width,oldCurrent+1);
            // ele.style.transform  = 'translateX('+width+'px)';
            // that.btnNext.style.backgroundColor = '#FB6C27';
            // that.btnBack.style.backgroundColor = '#FB6C27';
        }
    }
}