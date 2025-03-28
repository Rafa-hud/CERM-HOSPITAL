<div class="modal fade" id="confirmModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmar acción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="confirmMessage">¿Estás seguro de que deseas realizar esta acción?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmButton">Confirmar</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
        const confirmButton = document.getElementById('confirmButton');
        let formToSubmit = null;

        // Configurar los botones de eliminación
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                formToSubmit = this;
                document.getElementById('confirmMessage').textContent = 
                    '¿Estás seguro de que deseas eliminar este brazo robótico?';
                confirmModal.show();
            });
        });

        // Configurar el botón de confirmación
        confirmButton.addEventListener('click', function() {
            if (formToSubmit) {
                formToSubmit.submit();
            }
            confirmModal.hide();
        });
    });
</script>
@endpush