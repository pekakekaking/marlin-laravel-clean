<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задача</title>
    <link rel="stylesheet" href="https://happyhaha.github.io/css/dist/style.min.css">
</head>
<body>
    
    <h1 class="max-w-full mb-4 mt-5 text-3xl font-extrabold tracking-tight leading-none md:text-5xl dark:text-white text-center">Список статей</h1>    

    <div class="relative overflow-x-auto w-[85%] sm:rounded-lg mx-auto mt-9">
        <a href="17.table_2_create.html" class="inline-block focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Добавить статью</a>
        <a href="17.table_2_category_list.html" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Категории</a>
    </div>
    <div class="relative overflow-x-auto shadow-md w-[85%] sm:rounded-lg mx-auto mt-9">
        <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Наименование
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Текст
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Категория
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Кол-во просмотров
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Статус
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Изображение
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Действия
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="17.table_2_show.html">
                            Мой путь в PHP: от новичка до...
                        </a>
                        <!-- Мой путь в PHP: от новичка до Senior Developer -->
                    </th>
                    <td class="px-6 py-4">
                        Делюсь своей историей — как я начинал с PHP...
                        <!-- Делюсь своей историей — как я начинал с PHP, с какими трудностями столкнулись и какие шаги помогли мне стать Senior Developer. Советы и рекомендации для начинающих разработчиков -->
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block w-full bg-blue-100 text-blue-800 text-xs font-medium me-2 px-1.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 text-center">Мой опыт</span>
                    </td>
                    <td class="px-6 py-4">
                        83
                    </td>
                    
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Опубликован</span>
                    </td>

                    <td class="px-6 py-4">
                        <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg" class="w-[100px]" alt="">
                    </td>
                    <td class="px-6 py-4 flex">
                        <a href="17.table_2_edit.html" class="p-1" title="Редактировать">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" >
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                            </svg>
                        </a>
                        <a href="#" class="p-1" title="Удалить" onClick="return confirm('Вы уверены?')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" >
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                            </svg>
                        </a>
                    </td>
                </tr>

                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="17.table_2_show.html">
                            5 ошибок, которые я совершал...
                        </a>
                        <!-- 5 ошибок, которые я совершал в начале своего пути в PHP -->
                    </th>
                    <td class="px-6 py-4">
                        Никто не идеален, и я — не исключение. Рассказываю...
                        <!-- Никто не идеален, и я — не исключение. Рассказываю о типичных ошибках, которые я совершал в начале своей карьеры PHP-разработчика, и как их можно избежать. -->
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block w-full bg-blue-100 text-blue-800 text-xs font-medium me-2 px-1.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 text-center">Разработка</span>
                    </td>
                    <td class="px-6 py-4">
                        129
                    </td>
                    
                    <td class="px-6 py-4">
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Скрыт</span>
                    </td>

                    <td class="px-6 py-4">
                        <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-2.jpg" class="w-[100px]" alt="">
                    </td>
                    <td class="px-6 py-4 flex">
                        <a href="17.table_2_edit.html" class="p-1" title="Редактировать">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" >
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                            </svg>
                        </a>
                        <a href="#" class="p-1" title="Удалить" onClick="return confirm('Вы уверены?')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" >
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                            </svg>
                        </a>
                    </td>
                </tr>

                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="17.table_2_show.html">
                            Мой любимый инструментарий...
                        </a>
                        <!-- Мой любимый инструментарий PHP-разработчика -->
                    </th>
                    <td class="px-6 py-4">
                        Делюсь своим набором инструментов — IDE, фреймворки...
                        <!-- Делюсь своим набором инструментов — IDE, фреймворки, библиотеки, сервисы, — которые помогают мне быть более продуктивным и эффективным в работе. -->
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block w-full bg-blue-100 text-blue-800 text-xs font-medium me-2 px-1.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 text-center">PHP</span>
                    </td>
                    <td class="px-6 py-4">
                        322
                    </td>
                    
                    <td class="px-6 py-4">
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300">Скрыт</span>
                    </td>

                    <td class="px-6 py-4">
                        <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-1.jpg" class="w-[100px]" alt="">
                    </td>
                    <td class="px-6 py-4 flex">
                        <a href="17.table_2_edit.html" class="p-1" title="Редактировать">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" >
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                            </svg>
                        </a>
                        <a href="#" class="p-1" title="Удалить" onClick="return confirm('Вы уверены?')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" >
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                            </svg>
                        </a>
                    </td>
                </tr>

                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        <a href="17.table_2_show.html">
                            Как я справился с самым...
                        </a>
                        <!-- Как я справился с самым сложным проектом на PHP -->
                    </th>
                    <td class="px-6 py-4">
                        Рассказываю о самом запоминающемся...
                        <!-- Рассказываю о самом запоминающемся и сложном проекте в моей карьере PHP-разработчика. Какие проблемы возникли, какие решения были найдены и какие уроки я извлек из этого опыта. -->
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-block w-full bg-blue-100 text-blue-800 text-xs font-medium me-2 px-1.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 text-center">Фриланс</span>
                    </td>
                    <td class="px-6 py-4">
                        218
                    </td>
                    
                    <td class="px-6 py-4">
                        <span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Опубликован</span>
                    </td>

                    <td class="px-6 py-4">
                        <img src="https://flowbite.s3.amazonaws.com/docs/gallery/square/image-4.jpg" class="w-[100px]" alt="">
                    </td>
                    <td class="px-6 py-4 flex">
                        
                        <a href="17.table_2_edit.html" class="p-1" title="Редактировать">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" >
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                            </svg>
                        </a>
                        <a href="#" class="p-1" title="Удалить" onClick="return confirm('Вы уверены?')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" >
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                            </svg>
                        </a>
                    </td>
                </tr>
 
            </tbody>
        </table>
    </div>
    
  

    
    

    <script src="https://happyhaha.github.io/css/dist/flowbite.min.js"></script>

</body>
</html>