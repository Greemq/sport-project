const user = {
    state: () => ({
        user: null,
    }),
    mutations: {
        setUser(state, user) {
            state.user = user;
        },
        deleteUser(state) {
            state.user = null;
        }
    },
    actions: {},
    getters: {
        getUserName(state) {
            return state.user.name;
        }
    }
};

export default user;


