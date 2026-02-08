class ApiService {
    constructor(baseUrl) {
        this.baseUrl = baseUrl;
    }

    
    async request(endpoint, method = 'GET', data = null) {
        const options = {
            method,
            headers: {
                'Content-Type': 'application/json'
            }
        };

        if (data) {
            options.body = JSON.stringify(data);
        }

        try {
            const response = await fetch(`${this.baseUrl}/${endpoint}`, options);
            if (!response.ok) throw new Error('Erreur réseau');
            return await response.json();
        } catch (error) {
            console.error("Erreur API:", error);
            return { success: false, message: error.message };
        }
    }

    
    

    getMovies() { return this.request('api.php?action=getMovies'); }
    addMovie(movie) { return this.request('api.php?action=addMovie', 'POST', movie); }

    
    getRooms() { return this.request('api.php?action=getRooms'); }


    getShowtimes() { return this.request('api.php?action=getShowtimes'); }
}

const api = new ApiService(''); 