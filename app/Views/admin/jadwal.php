<div class="row" ng-controller="jadwalController">
    <!-- <div class="col-md-3">
                <div class="sticky-top mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Draggable Events</h4>
                        </div>
                        <div class="card-body">
                            <div id="external-events">
                                <div class="external-event bg-success">Lunch</div>
                                <div class="external-event bg-warning">Go home</div>
                                <div class="external-event bg-info">Do homework</div>
                                <div class="external-event bg-primary">Work on UI design</div>
                                <div class="external-event bg-danger">Sleep tight</div>
                                <div class="checkbox">
                                    <label for="drop-remove">
                                        <input type="checkbox" id="drop-remove">
                                        remove after drop
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Create Event</h3>
                        </div>
                        <div class="card-body">
                            <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                <ul class="fc-color-picker" id="color-chooser">
                                    <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                                    <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                                </ul>
                            </div>
                            <div class="input-group">
                                <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                                <div class="input-group-append">
                                    <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
    <div class="col-md-12">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="card-body p-0">
                            <div id="calendar"></div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-rri">
                    <h5 class="modal-title">Info Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label for="">Spot Iklan</label>
                    <div class="table-responsive p-0">
                        <table class="table table-sm table-hover table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Jenis</th>
                                    <th>Waktu Tayang</th>
                                    <th>Topik</th>
                                    <th>Customer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in dataDetail.spot">
                                    <td>{{item.kategori}}</td>
                                    <td>{{item.jenis}}</td>
                                    <td>{{item.waktu}}</td>
                                    <td>{{item.topik}}</td>
                                    <td>{{item.fullname}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <label for="">Pengumuman</label>
                    <div class="table-responsive p-0">
                        <table class="table table-sm table-hover table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>Kategori</th>
                                    <th>Jenis</th>
                                    <th>Waktu Tayang</th>
                                    <th>Topik</th>
                                    <th>Customer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="item in dataDetail.pengumuman">
                                    <td>{{item.kategori}}</td>
                                    <td>{{item.jenis}}</td>
                                    <td>{{item.waktu}}</td>
                                    <td>{{item.topik}}</td>
                                    <td>{{item.fullname}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>