module.exports = {
    async rewrites() {
        return [
            {
                source: "/api/:path*",
                destination: "http://localhost/XS/public/api/:path*",
            },
        ];
    },
};