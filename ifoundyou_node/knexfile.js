// Update with your config settings.
module.exports = {
  development: {
    client: 'mysql',
    connection: {
      hostname: 'http://localhost:3000',
      database: 'ifoundyou',
      user: 'root',
      password: ''
    },
    pool: {
      min: 2,
      max: 10
    },
    migrations: {
      tableName: 'migrations'
    }
  },
  staging: {
    client: 'mysql',
    connection: {
      hostname: 'http://localhost:3000',
      database: 'ifoundyou',
      user: 'root',
      password: ''
    },
    pool: {
      min: 2,
      max: 10
    },
    migrations: {
      tableName: 'migrations'
    }
  },
  production: {
    client: 'mysql',
    connection: {
      hostname: 'http://localhost:3000',
      database: 'knex',
      user: 'root',
      password: ''
    },
    pool: {
      min: 2,
      max: 10
    },
    migrations: {
      tableName: 'migrations'
    }
  }
};
