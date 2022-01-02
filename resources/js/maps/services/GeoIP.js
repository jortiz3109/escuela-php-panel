import axios from "axios";
class GeoIP {
    apiKey = ''
    route = ''

    constructor() {
        this.apiKey = process.env.MIX_IP_STACK_API_KEY
        this.route = process.env.MIX_IP_STACK_ROUTE
    }

    getLocation(ip) {
        return axios.get(this.route + ip + '?access_key=' + this.apiKey)
    }
}

export default new GeoIP()
