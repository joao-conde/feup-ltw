function changeActiveTab(index) {
    menu_items = document.querySelectorAll("nav#menu li");

        for (let i = 0; i < menu_items.length; i++) {
        let item = menu_items[i];
        console.log(menu_items[i]);
        console.log(i);

        if (i == index)
            item.classList.add("active");
        else
            item.classList.remove("active");
    }
}