<!--Estado-->
<div class="contenedor_elemento_formulario">
    <label for="estado">Estado del Producto:</label>
    <div class="estado">
        <label>
            <input type="radio" value="1" name="estado" wire:model.defer="estado" id="estado">
            Si
        </label>

        <label>
            <input type="radio" value="0" name="estado" wire:model.defer="estado" id="estado">
            No
        </label>
    </div>
    @error('estado')
        <span>
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    <button wire:click="actualizarEstadoProducto" wire:loading.attr="disabled" wire:target="actualizarEstadoProducto">
        Actualizar estado
    </button>
</div>
