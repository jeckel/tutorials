# Step 2 - Grafana with PostgreSQL as a config backend

:arrow_right: [Read full tutorial (in french for now)](http://www.jeckel.fr/)

# Requirements

- docker
- docker-compose

# How to use it

In a shell command line, run :

```bash
$> ./docker-compose up -d grafana-storage
// wait a litle

$> ./docker-compose up
```

Open your browser at this location : http://localhost:3000/

Login with `admin` / `admin`

And you're done.