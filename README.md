level user  : admin 

dashboard admin 
crud hadiah ( sample phone,dll)
crud vocer 
	- kode vocer di generate system ( 6++ digit )
	- vocer unik

assign vocer hadiah 
	- kalo zonk dia langsung 100 vocer (sekali create)
	- kalo yang dapat hadiah , dinamis


=================================================
frontend api
rules :
	 - vocer hanya bisa di gunakan 1x 
	 - jika vocer di gunakan muncul notif 
		1) vocer telah terpakai
		2) vocer anda terpakai dan telah claim hadiah (ga di sebutin hadiah apa)
	- ketika fe call api spin ( status vocer used)



alur spin
	- fe input vocer
	- fe tombol spin kebuka
	- be validasi vocer ( vocer anda zonk ) 
	- fe dapet notif
==================================================
- laravel full api
- fe javascript	

	


