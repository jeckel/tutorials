# Step 4 - Export grafana configuration

:arrow_right: [Read full tutorial (in french for now)](http://www.jeckel.fr/)

# Requirements

- docker
- docker-compose

# How to use it

In a shell command line, run :

```bash
$> ./start.sh
```

Open your browser at this location : http://localhost:3000/

Login with `admin` / `admin`

Update your settings, configure your boards, datasource, etc...

And then, backup the resulting configuration:

```bash
$> ./dump.sh
````

The dump will be available in the `export/` directory.