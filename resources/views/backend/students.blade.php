@extends('backend.master')

@section('content')
<div class="container" id="app">
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Test Entretien Web Application To_Do Laravel Vue</h3>
                    <p> try : php artisan migrate:fresh --seed 
                        
                    </p>
                </div>
            </div>
    
             <students-index></students-index>
        </div>
    </div>
</div>
@endsection
