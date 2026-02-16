/**
 * Función para editar un comentario
 * Carga los datos del comentario en el formulario y actualiza la acción del form
 */
export function editComment(id, rating, message) {
    const formContainer = document.querySelector(".comment-form-container");
    if (formContainer) {
        formContainer.scrollIntoView({ behavior: "smooth" });
        const ratingSelect = document.getElementById("rating");
        const messageTextarea = document.getElementById("message");

        if (ratingSelect) {
            ratingSelect.value = rating;
        }

        if (messageTextarea) {
            messageTextarea.value = message;
        }

        const form = formContainer.querySelector("form");
        if (form) {
            form.action = `/comments/${id}`;

            let methodInput = form.querySelector('input[name="_method"]');
            if (!methodInput) {
                methodInput = document.createElement("input");
                methodInput.type = "hidden";
                methodInput.name = "_method";
                methodInput.value = "PUT";
                form.appendChild(methodInput);
            } else {
                methodInput.value = "PUT";
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.innerText = "Actualizar Comentario";
            }

            const title = formContainer.querySelector("h3");
            if (title) {
                title.innerText = "Edita tu comentario";
            }
        }
    }
}

window.editComment = editComment;
