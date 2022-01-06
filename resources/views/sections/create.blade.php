<div class="modal fade" id="addSection" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add new section</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store" method="post" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    @forelse ($addMore as $more)
                        <div class="row mb-2">
                            <div class="col-md-10">
                                <input type="text" name="section_name" id="section_name" class="form-control"
                                    placeholder="Section Name" autocomplete="off">
                                @error('section_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-1 mt-4" data-toggle="tooltip" data-placement="top" title="status">
                                <label class="switch">
                                    <input type="checkbox" name="section_status" id="section_status">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="col-md-1 mt-4">
                                <button class="btn-success">
                                    <i class="fa fa-plus" wire:ignore wire:click.prevent="AddMore"></i>
                                </button>

                                @if ($loop->index > 0)

                                    <button class="btn-danger">
                                        <i class="fa fa-plus" wire:ignore
                                            wire:click.prevent="Remove({{ $loop->index }})"></i>
                                    </button>
                            </div>
                    @endif
            </div>

        @empty

            @endforelse
            </form>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary" style="width: 100%">Save
                changes</button>
            <button type="button" class="btn btn-danger" style="width: 100%" data-bs-dismiss="modal">Close</button>
        </div>
    </div>
</div>
</div>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked+.slider {
        background-color: #2196F3;
    }

    input:focus+.slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
