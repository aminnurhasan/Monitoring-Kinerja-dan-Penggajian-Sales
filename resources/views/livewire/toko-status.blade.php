<div class="form-check form-switch">
  {{-- <input class="form-check-input"  wire:model.lazy="status" type="checkbox" role="switch" @if($status) checked @endif> --}}
  <input type="checkbox" name="my-checkbox" wire:model.lazy="status" role="switch" @if($status) checked @endif data-bootstrap-switch>
</div>