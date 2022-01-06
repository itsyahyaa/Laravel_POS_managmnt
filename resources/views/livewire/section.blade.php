<div class="conatiner-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSection"><i
                                    class="fa fa-plus-circle"></i> Add Section</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('sections.table')
                </div>
            </div>
        </div>
    </div>
    @include('sections.create')
</div>
