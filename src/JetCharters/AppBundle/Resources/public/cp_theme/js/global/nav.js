  // Active menu item script
    var elem = document.getElementById('dashboard-menu');
    var controller = elem.dataset.currentcontroller;
    var items = elem.getElementsByTagName('li');

    for (var i = items.length - 1; i >= 0; i--) {
        if (items[i].dataset.controller && controller.search(items[i].dataset.controller) != -1) {
            items[i].className = 'active';
            pointer = document.createElement("div");
            pointer.className = 'pointer';
            arrow = document.createElement("div");
            arrow.className = 'arrow';
            // arrow.style.left = '4px'; // Admin adjustment
            arrow_border = document.createElement("div");
            arrow_border.className = 'arrow_border';
            // arrow_border.style.left = '4px'; // Admin adjustment

            items[i].appendChild(pointer);
            pointer.appendChild(arrow);
            pointer.appendChild(arrow_border);

            if(items[i].querySelector('.submenu')) {
                items[i].querySelector('.submenu').style.display = 'block';
            }

            break;
        }
    };