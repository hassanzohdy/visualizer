class Config {
    /**
     * Get value from config
     * 
     * @param string namespace
     * @param mixed defaultValue
     * @returns mixed
     */
    static get(namespace, defaultValue = null) {
        return Object.get(Config.data, namespace, defaultValue);
    }

    /**
     * Extend config data
     * 
     * @param string namespace
     * @param mixed value
     * @returns void
     */
    static extend(namespace, value) {
        if (Is.object(namespace) && ! value) {
            Config.data = Object.merge(Config.data, namespace);
        } else {
            Object.set(Config.data, namespace, value);   
        }
    }

    /**
     * Add a key/value pair to config
     * 
     * @param string key
     * @param mixed value
     * @returns void
     */
    static set(key, value) {
        Object.set(Config.data, key, value);   
    }
}

Config.data = {};

// quick access to `Config.get` method
const config = Config.get;