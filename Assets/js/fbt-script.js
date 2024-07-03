jQuery(document).ready(function($) {
    $('#fbt-add-all-to-cart').click(function(event) {
        let product_ids = [];
        $('input[name="fbt_product_ids[]"]:checked').each(function() {
            product_ids.push($(this).val());
        });
        if (product_ids.length > 0) {
            $.post(fbt_ajax.ajax_url, {
                action: 'fbt_add_to_cart',
                product_ids: product_ids,

            }, function(response) {

                createToast('success', 'bx bxs-check-circle', 'Success', response);


            }).fail(function(xhr, status, error) {
                createToast('warning', 'bx bxs-radiation', 'Warning', error);
            });
        } else {
            createToast('info', 'bx bxs-alarm-exclamation', 'Info', 'Please select at least one product.');
        }
    });

    function createToast(type, icon, title, text) {
        let newToast = document.createElement('div');
        newToast.classList.add('toast', type);
        newToast.innerHTML = `
            <i class='${icon}'></i>
            <div class="content">
                <div class="title">${title}</div>
                <span class="toast-msg">${text}</span>
            </div>
            <i class='bx bx-x' onclick="(this.parentElement).remove()"></i>
        `;
        document.querySelector('.notification').appendChild(newToast);

        // Auto remove after 5 seconds
        newToast.timeOut = setTimeout(function() {
            newToast.remove();
        }, 5000);
    }
});
