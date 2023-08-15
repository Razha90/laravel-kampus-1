<!DOCTYPE html>
<html>
	<head>
		<title>Kampus Jaya</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
		<link rel="stylesheet" href="{{asset('css/styles.css')}}" />
	</head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<body>
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Pesan Penting!!</h4>
					</div>
					<div class="modal-body">
						<p>
							@if (session("Message")) {{ session("Message") }} @endif
						</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>

		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">Kampus Jaya</a>
				</div>
				<div class="collapse navbar-collapse" id="navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="/">Home</a></li>
						@if (auth()->user()->role == 'Admin')
      <li><a href="{{ url('/mahasiswa') }}">Mahasiswa</a></li>
      <li><a href="{{ url('/dosen') }}">Dosen</a></li>
      @endif
						<li class="active"><a href="{{ url('/jurusan') }}">Jurusan</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						@auth
						<li>
									<form method="post" action="{{ url('/logout') }}" class="navbar-form">
										@csrf
										<button type="submit" class="btn btn-link">Logout</button>
									</form>
								</li>
						<li class="dropdown">
							<a class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
								{{ auth()->user()->name }}
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{{ url('/profile') }}">Profile</a></li>
								@if (auth()->user()->role == 'Admin') 
      <li><a href="{{ url('/dashboard') }}">Dasboard</a></li>
      @endif
							</ul>
						</li>
						@else
						<li><a href="{{ url('/login') }}">Login</a></li>
						@endauth
					</ul>
				</div>
			</div>
		</nav>

		<div class="container" id="appVue">
    <br>
    <br>
    <br>
			<div class="modal fade" id="modalTambahData" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">×</button>
							<h4 class="modal-title">Warning</h4>
						</div>
						<div class="modal-body">
							<form role="form" v-bind:action="urlUpdate" method="POST">
								@csrf @method('PUT')
								<div class="box-body">
									<div class="form-group">
										<label for="kode">Kode Jurusan</label>
										<input type="number" class="form-control" id="kode" placeholder="Kode Matkul" v-model="kode" name="kode" />
									</div>
									<div class="form-group">
										<label for="nama-jurusan">Nama Jurusan</label>
										<input type="text" class="form-control" id="nama-jurusan" placeholder="Nama Jurusan" v-model="nama_jurusan" name="jurusan" />
									</div>
								</div>
								<button type="submit" class="btn btn-primary">Submit</button>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Kode Matkul</th>
									<th>Nama Jurusan</th>
									<th>Created At</th>
									<th>Updated At</th>
									@if (auth()->user()->role == 'Admin')
									<th>Action</th>
									@endif
								</tr>
							</thead>
							<tbody>
								<template v-for="item in list_mahasiswa">
									<tr>
										<td>@{{ item.id }}</td>
										<td>@{{ item . nama_jurusan }}</td>
										<td>@{{ formatDate(item . created_at) }}</td>
										<td>@{{ formatDate(item . updated_at) }}</td>
										@if (auth()->user()->role == 'Admin')
										<td>
											<button v-on:click.prevent="editData(item.id)" class="btn btn-xs btn-warning">Edit Data</button>

											<form ref="deleteForm" id="delete-form" method="POST" style="display: none;">
												@csrf @method('DELETE')
											</form>
											<button v-on:click.prevent="showConfirmation(item.id)" class="btn btn-xs btn-danger">Delete Data</button>
										</td>
										@endif
									</tr>
								</template>
							</tbody>
						</table>
            <div v-if="isLoading" class="text-center">
      <i class="fa fa-spinner fa-spin"></i> Loading...
    </div>
					</div>
				</div>
			</div>
			<ul class="pagination" style="display: flex; justify-content:center;">
				<li :class="[page.current_page != 1 ? 'page-item': 'page-item disabled']"><a class="page-link" v-on:click.prevent="getData(page.current_page-1)">Previos</a></li>
				<li v-if="page.current_page > 1">
					<a v-if="page.current_page-1 > 1" class="page-item" v-on:click.prevent="(page.current_page-2)">@{{page.current_page-2}}</a>
					<a class="page-link" v-on:click.prevent="(page.current_page-1)">@{{page.current_page-1}}</a>
				</li>
				<li class="page-item disabled"><a class="page-link">@{{page.current_page}}</a></li>
				<li v-if=" page.current_page < page.last_page">
					<span class="page-link" v-on:click.prevent="getData(page.current_page+1)">@{{page.current_page+1}}</span>
					<span v-if="page.current_page+1 < page.last_page" v-on:click.prevent="getData(page.current_page+2)">@{{page.current_page+2}}</span>
				</li>
				<li :class="[page.last_page != page.current_page ? 'page-item' : 'page-item disabled']">
					<span class="page-link" v-on:click.prevent="getData(page.last_page == page.current_page ? page.last_page : page.current_page+1)">Next</span>
				</li>
			</ul>
		</div>

		<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

		<script>
			        @if(session("Message"))
			        $(document).ready(function() {
			  $('#myModal').modal('show');
			});
			        @endif
			        var vue = new Vue({
			            el: "#appVue",
			            data: {
			                list_mahasiswa: [],
			                page: [],
			                kode: null,
			                nama_jurusan: null,
			                urlUpdate:null,
                      isLoading:true
			            },
			            mounted() {
			                this.getData();
			            },
			            methods: {
			            getData: function(id=0) {
                    this.isLoading = true;
			                let url = `{{ url('/api/data-jurusan') }}?page=` + id;
			                axios.get(url)
			                    .then(resp => {
			                        console.log(resp);
                              this.isLoading = false;
			                        this.list_mahasiswa = resp.data.data;
			                        this.page = resp.data.pagination;
			                    })
			                    .catch(err => {
			                        console.log(err);
			                    })
			                    .finally(() => {
			                    })
			            },
			            MahasiswaBaru: function() {
			        $('#modalTambahData').modal('show');
			    },
			    editData: function(id) {
			    this.nim = id;
			    var url = "{{url('/admin/jurusan')}}" + "/" + id;
			    this.urlUpdate= "{{ url('/admin/jurusan') }}" + "/" + id;
			    axios.get(url)
			        .then(resp => {
			            var mahasiswa = resp.data;
			            this.kode = mahasiswa.id;
			            this.nama_jurusan = mahasiswa.nama_jurusan;
			            this.MahasiswaBaru();
			        })
			        .catch(err => {
			            alert('error');
			            console.log(err);
			        })
			        .finally(() => {
			        })
			},
			hapusData: function(id) {
			    const form = document.getElementById('delete-form');
			            form.action = '/admin/jurusan/' + id;
			            form.submit();
			        },
			        showConfirmation(id) {
			      if (confirm('Apakah Yankin Ingin Hapus?')) {
			        this.hapusData(id);
			      }
			    },
			    formatDate(dateTimeString) {
			      const options = { year: 'numeric', month: 'long', day: 'numeric' };
			      const formattedDate = new Date(dateTimeString).toLocaleDateString('id-ID', options);
			      return formattedDate;
			    }

			        }})
		</script>
	</body>
</html>
