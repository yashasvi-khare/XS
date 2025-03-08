first of all
Clone karne k baad 3 commands run karne hain
1. `composer install`,
2. `cd frontend`
3. `npm install`

After installing the packages by running above commands 

Ab Navigate to `/frontend/src/data`

sabhi `.json` files yaha par data ka kaam kar rhe hain..

first of all you need to remove the usage of `.json` files for data

we need to integrate with `Laravel APIs` using fetch
    (see /frontend/src/components/landing/Trending.jsx - line no.11)

For creating apis *- define routes in `/routes/api.php` & create Controllers, Model etc without .blade.php view files
all the other process goes as usual

Suppose kro ki Ek laravel ka project bana rhe/rhi ho bas view ka tension nhi hai..

tables banane k liye `src/data/` k andr jo `.json` files hain unko open karna hai
ab usme jitni `keys` rhengi wo table k column rhenge laravel ki tables k

*Most importantly*
run `npm run dev` inside `/frontend` directory to view changes

+ apne-apne changes apne name se ek branch create krlena hai 
tb usi branch par push karna hai

git branch adbhut
git branch yashasvi