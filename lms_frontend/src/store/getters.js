const getDisplayLoader = (state) => {
	return state.displayLoader
}

const getLoggedUser = (state) => {
    let user = state.loggedUser
    if(user) {
        user = JSON.parse(user)
    }
	return user
    // window.console.log(user)
}

export default {
    getDisplayLoader,
    getLoggedUser
}