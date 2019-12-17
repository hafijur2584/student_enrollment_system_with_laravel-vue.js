class AppStorage{
	storageToken(token){
		localStorage.setItem('token',token);
	}

	storageUser(user){
		localStorage.setItem('user',user);
	}

	store(token,user){
		this.storageToken('token',token);
		this.storageUser('user',user);
	}
	clear(){
		localStorage.removeItem('token');
		localStorage.removeItem('user');
	}
	getUser(){
		localStorage.getItem('user');
	}
}

export default AppStorage = new AppStorage();