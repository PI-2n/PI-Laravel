document.addEventListener('DOMContentLoaded', function() {
    const paymentForm = document.getElementById('paymentForm');
    const savedCardsSection = document.getElementById('savedCardsSection');
    const newCardSection = document.getElementById('newCardSection');
    const cardIdSelect = document.getElementById('card_id');
    
    // Campos de tarjeta nueva
    const cardNumber = document.getElementById('card_number');
    const cardHolderName = document.getElementById('card_holder_name');
    const expirationDate = document.getElementById('expiration_date');
    const cvv = document.getElementById('cvv');

    // Función para actualizar los atributos required
    function updateRequiredFields() {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
        
        if (paymentMethod === 'saved_card') {
            // Tarjeta guardada: requerir card_id, no requerir campos de nueva tarjeta
            if (cardIdSelect) cardIdSelect.required = true;
            if (cardNumber) cardNumber.required = false;
            if (cardHolderName) cardHolderName.required = false;
            if (expirationDate) expirationDate.required = false;
            if (cvv) cvv.required = false;
        } else if (paymentMethod === 'new_card') {
            // Nueva tarjeta: no requerir card_id, requerir campos de nueva tarjeta
            if (cardIdSelect) cardIdSelect.required = false;
            if (cardNumber) cardNumber.required = true;
            if (cardHolderName) cardHolderName.required = true;
            if (expirationDate) expirationDate.required = true;
            if (cvv) cvv.required = true;
        }
    }

    // Mostrar/Ocultar secciones según método de pago
    paymentForm.addEventListener('change', function(e) {
        if (e.target.name === 'payment_method') {
            if (e.target.value === 'saved_card') {
                if (savedCardsSection) savedCardsSection.style.display = 'block';
                newCardSection.style.display = 'none';
            } else {
                if (savedCardsSection) savedCardsSection.style.display = 'none';
                newCardSection.style.display = 'block';
            }
            updateRequiredFields();
        }
    });

    // Limpiar número de tarjeta antes de enviar el formulario
    paymentForm.addEventListener('submit', function(e) {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
        
        if (paymentMethod === 'new_card' && cardNumber) {
            // Eliminar espacios del número de tarjeta
            cardNumber.value = cardNumber.value.replace(/\s+/g, '');
            
            // Validar longitud mínima (13-19 dígitos)
            if (cardNumber.value.length < 13 || cardNumber.value.length > 19) {
                e.preventDefault();
                alert('El número de tarjeta debe tener entre 13 y 19 dígitos');
                cardNumber.focus();
                return false;
            }
        }
    });

    // Inicializar los atributos required al cargar la página
    updateRequiredFields();

    // Formato automático para fecha de expiración
    const expirationInput = document.getElementById('expiration_date');
    if (expirationInput) {
        expirationInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            e.target.value = value;
        });
    }

    // Limitar CVV a 4 dígitos
    const cvvInput = document.getElementById('cvv');
    if (cvvInput) {
        cvvInput.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 4);
        });
    }

    // Formato para número de tarjeta
    const cardNumberInput = document.getElementById('card_number');
    if (cardNumberInput) {
        cardNumberInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            value = value.replace(/(.{4})/g, '$1 ').trim();
            e.target.value = value;
        });
    }
});