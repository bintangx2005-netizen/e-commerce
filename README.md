# Multi-Vendor Ecommerce Website
![Work in Progress](https://img.shields.io/badge/Status-Work%20in%20Progress-orange)


**This is the repository for a multi-vendor ecommerce website built using Laravel, JavaScript, and Fetch API. The website has three different user roles: admin, vendor, and user. Each role has specific permissions and access levels within the system. The website includes features such as a shopping cart, product categories, checkout options, payment integration with SSL Commerce, multi-user roles, and multiple permissions.**

## Features

The ecommerce website offers the following features:

- **Multiple User Roles**: The website has separate dashboards for admin, vendor, and user, each with their own set of functionalities and permissions.

- **Cart System**: Website visitors can add products to the cart without logging in. The cart system allows adding products without page reloading.

- **Product Variations**: Each product can have multiple images, sizes, and colors.

- **Product Filtering**: Users can browse products by category, shop, and brand to easily find their desired items.

- **Multiple Payment Methods**: The website supports multiple payment methods, including cash in and SSL Commerce integration.

- **User Reviews and Ratings**: After purchasing a product, users can provide reviews and ratings.

- **Product Delivery Tracking**: Users can track the delivery process and see the current state of their ordered products.

- **Product Returns**: Users have the option to return products they are not satisfied with.



![screenshots](https://raw.githubusercontent.com/ali-azgar-rakib/Multi-Vendor-Ecommerce-Website-With-Laravel/master/public/screenshots/home-page.png)


## Installation

To install and run the project locally using Laravel Sail, please follow these steps:

1. Clone the repository:

```bash
git clone https://github.com/ali-azgar-rakib/Multi-Vendor-Ecommerce-Website-With-Laravel.git
cd Multi-Vendor-Ecommerce-Website-With-Laravel
```

2. Install dependencies using Composer:

```bash
composer install

```
3. Set up Laravel Sail:
```bash

./vendor/bin/sail up

```
**Note**: If you face any issues with the `./vendor/bin/sail up` command, open the `.env` file and add the following line: `APP_PORT=8080`. Save the file and retry running `./vendor/bin/sail up`.

4. Create the .env file:

```bash

cp .env.example .env

```

5. Generate an application key:
```bash
./vendor/bin/sail artisan key:generate


```

6. Run database migrations:
```bash

./vendor/bin/sail artisan migrate

```

7. Seed the database (optional):
If you want to populate the database with sample data, run the following command:

```bash

./vendor/bin/sail artisan db:seed

```

8.Build the frontend assets:

```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```

9. You can now access the website by visiting http://localhost:8080 in your web browser.


## User Roles and Permissions

- **Admin**:
  - Can access the admin dashboard with full administrative privileges.
  - Manage vendors and user accounts.
  - View and manage products, categories, and orders.
  - Perform CRUD operations on all entities within the system.

- **Vendor**:
  - Can access the vendor dashboard.
  - Add new products to the system.
  - Manage their own product inventory.
  - View and update their orders.

- **User**:
  - Can create an account, log in, and log out.
  - Browse products by category or search for specific items.
  - Add products to the cart and proceed to checkout.
  - Make payments securely using SSL Commerce integration.
  - View and manage their own orders.

## Technologies Used

- Laravel: A PHP web framework used for building the backend of the application.
- JavaScript: Used for implementing dynamic frontend functionality.
- Fetch API: Used for making asynchronous requests to the server.
- SSL Commerce: Payment gateway integration for secure online payments.

## Contributing

We welcome contributions to enhance the functionality and features of this ecommerce website. If you would like to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and commit them with descriptive messages.
4. Push your changes to your forked repository.
5. Submit a pull request explaining your changes and the rationale behind them.

Please ensure your code follows the existing coding style and includes appropriate tests for any new functionality.

## License

This project is licensed under the [MIT License](https://en.wikipedia.org/wiki/MIT_License).



