<div class="form-check form-switch">
  <input class="form-check-input"  wire:model.lazy="status" type="checkbox" role="switch" @if($status) checked @endif>
  {{-- <input class="form-check-input" data-bootstrap-switch type="checkbox" name="status" wire:model.lazy="status" role="switch" @if($status) checked @endif> --}}
</div>