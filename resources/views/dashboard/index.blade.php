@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">
        <div class="mt-3 mb-4 space-between-elements">
            <h2 class="ms-2 mt-3 me-3">Dashboard</h2>
            <ol class="breadcrumb mb-3 mt-3 p-1 rounded bg-light">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>

        <section class="content">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-lg-3 col-6">
                        
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>5.404</h3>
    
                                <p>Casos Notificados (Geral)</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-6">
                       
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>65</h3>
    
                                <p>Casos Notificados SE 44</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-6">
                       
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>85</h3>
    
                                <p>Casos Notificados SE 45</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-6">
                        
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>30.77<sup style="font-size: 20px">%</sup></h3>
    
                                <p>Taxa de Crescimento</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer">Mais informações <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </div>
@endsection
