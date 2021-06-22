var flag_ham=0;
function hamb_toggle() {
    if (flag_ham==0) {
        document.getElementsByClassName("nav_items_after")[0].classList.add("nav_items_after_t1");
        flag_ham=1;
    }
    else{
        document.getElementsByClassName("nav_items_after")[0].classList.remove("nav_items_after_t1");
        flag_ham=0;
    }
}