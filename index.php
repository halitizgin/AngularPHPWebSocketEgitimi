<html ng-app="AngularPHP">
    <head>
        <title>Angular, PHP, Websocket</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/custom.css">
        <link rel="stylesheet" href="assets/css/fontawesome.css">
    </head>
    <body ng-controller="AngularPHPController">
        <div class="container" style="margin-top: 10px;">
            <div class="row" style="margin-bottom: 10px;">
                <div class="col-md-2">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#VeriEkleModal">
                    Ekle
                    </button>
                </div>
                <div class="col-md-4">
                    <input placeholder="Aramak istediğiniz veriyi giriniz" type="text" class="form-control"/>
                </div>
                <div class="col-md-2">
                    <select placeholder="Film Türü" class="form-control">
                        <option value="">Tümü</option>
                        <option>Bilim-Kurgu</option>
                        <option>Dram</option>
                        <option>Aksiyon</option>
                        <option>Macera</option>
                        <option>Fantastik</option>
                        <option>Korku</option>
                        <option>Gerilim</option>
                        <option>Komedi</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input class="form-control" placeholder="Çıkış Yılı" type="number" />
                </div>
                <div class="col-md-2">
                    <input class="form-control" placeholder="IMDB" type="number" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <ul class="list-group" ng-repeat="movie in movies">
                        <li class="list-group-item">{{movie.film_adi}}
                            <button ng-click="prepareDelete(movie.film_id, movie.film_adi)" type="button" data-toggle="modal" data-target="#VeriSilModal"  class="close" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                            <button class="close" aria-label="Close" style="margin-top: 5px; margin-right: 10px;" data-toggle="modal" data-target="#VeriGuncelleModal"><i class="far fa-edit fa-xs"></i></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/angular.min.js"></script>
        <script src="assets/js/custom.js"></script>

        <!-- Veri Ekle Modal -->
        <div class="modal fade" id="VeriEkleModal" tabindex="-1" role="dialog" aria-labelledby="VeriEkleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="VeriEkleModalLabel">Film Ekle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            Film Adı
                            <input ng-model="addName" placeholder="Film Adı"class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            Film Türü
                            <select ng-model="addType" placeholder="Film Türü" class="form-control">
                                <option value="">Film Türü</option>
                                <option>Bilim-Kurgu</option>
                                <option>Dram</option>
                                <option>Aksiyon</option>
                                <option>Macera</option>
                                <option>Fantastik</option>
                                <option>Korku</option>
                                <option>Gerilim</option>
                                <option>Komedi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Film Çıkış Yılı
                            <input ng-model="addYear" min="1900" max="2019" placeholder="Film Çıkış Yılı" class="form-control" type="number"/>
                        </div>
                        <div class="form-group">
                            Film IMDB Puanı
                            <input ng-model="addImdb" min="0" max="10" placeholder="Film IMDB" class="form-control" type="number"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button ng-disabled="addName == '' || addYear < 1900 || addYear == '' || addType == '' || addImdb < 0 || addImdb > 10 || addImdb == ''" ng-click="addMovie()" type="button" class="btn btn-success" data-dismiss="modal">Ekle</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Veri Güncelle Modal -->
        <div class="modal fade" id="VeriGuncelleModal" tabindex="-1" role="dialog" aria-labelledby="VeriGuncelleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="VeriGuncelleModalLabel">Film Güncelle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <div class="form-group">
                            Film Adı
                            <input placeholder="Film Adı" class="form-control" type="text"/>
                        </div>
                        <div class="form-group">
                            Film Türü
                            <select placeholder="Film Türü" class="form-control">
                                <option value="">Film Türü</option>
                                <option>Bilim-Kurgu</option>
                                <option>Dram</option>
                                <option>Aksiyon</option>
                                <option>Macera</option>
                                <option>Fantastik</option>
                                <option>Korku</option>
                                <option>Gerilim</option>
                                <option>Komedi</option>
                            </select>
                        </div>
                        <div class="form-group">
                            Film Çıkış Yılı
                            <input placeholder="Film Çıkış Yılı" class="form-control" type="number"/>
                        </div>
                        <div class="form-group">
                            Film IMDB Puanı
                            <input placeholder="Film IMDB" class="form-control" type="number"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Veri Sil Modal -->
        <div class="modal fade" id="VeriSilModal" tabindex="-1" role="dialog" aria-labelledby="VeriSilModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="VeriSilModalLabel">Film Sil</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        "{{willDeleteName}}" filmini silmek istediğinize emin misiniz?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Hayır</button>
                        <button ng-click="deleteMovie()" type="button" class="btn btn-success" data-dismiss="modal">Evet</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>