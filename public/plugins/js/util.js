class Util {
    // static seleccionarMenu(url) {
    //     $("ul.nav-sidebar a").filter(function () {
    //         return this.href == url;
    //     }).parent().addClass("active");

    //     $("ul.nav-treeview a").filter(function () {
    //         return this.href == url;
    //     }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open');
    // }

    static mensaje(tipo, mensaje) {
        Lobibox.notify(tipo, {
            size: "mini",
            rounded: false,
            sound: false,
            delayIndicator: false,
            iconSource: "fontAwesome",
            position: "top right",
            msg: mensaje
        });
    }
}