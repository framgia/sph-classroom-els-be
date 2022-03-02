<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
        
                [
                    'category_id' => 1,
                    'name' => 'HTML',
                    'description' => 'A standardized system for tagging text files to achieve font, color, graphic, and hyperlink effects on World Wide Web pages.',
                    'image' => 'html.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 1,
                    'name' => 'Arrays',
                    'description' => 'Is a data structure consisting of a collection of elements, each identified by at least one array index or key.',
                    'image' => 'array.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 1,
                    'name' => 'Classes and objects',
                    'description' => 'Describes the contents of the objects that belong to it describes an aggregate of data fields , and defines the operations an object is an element of a class.',
                    'image' => 'claob.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 1,
                    'name' => 'ECMAScript-ES6',
                    'description' => 'ECMAScript is a standard for scripting languages such as JavaScript, JScript, etc. It is a trademark scripting language specification.',
                    'image' => 'ecma.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 1,
                    'name' => 'DOM',
                    'description' => 'Is an application programming interface (API) for HTML and XML documents.',
                    'image' => 'dom.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 1,
                    'name' => 'Object-Oriented Programming',
                    'description' => 'Is a computer programming model that organizes software design around data, or objects, rather than functions and logic.',
                    'image' => 'obj.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 15,
                    'name' => 'Encapsulation',
                    'description' => 'Encapsulation is the bundling of data with the methods that operate on that data.',
                    'image' => 'encap.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 15,
                    'name' => 'Polymorphism',
                    'description' => 'Polymorphism is the method in an object-oriented programming language that performs different things as per the object is class',
                    'image' => 'poly.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 15,
                    'name' => 'Abstraction',
                    'description' => 'Abstraction is the concept of object-oriented programming that “shows” only essential attributes and “hides” unnecessary information.',
                    'image' => 'abs.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 15,
                    'name' => 'Inheritance',
                    'description' => 'Inheritance is the mechanism of basing an object or class upon another object (prototype-based inheritance) or class (class-based inheritance), retaining similar implementation.',
                    'image' => 'inheritance.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 2,
                    'name' => 'Biology',
                    'description' => 'Biology is a branch of science that deals with living organisms and their vital processes',
                    'image' => 'bio.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 2,
                    'name' => 'Astronomy',
                    'description' => 'Astronomy is the study of everything in the universe beyond Earth is atmosphere. That includes objects we can see with our naked eyes, like the Sun, the Moon, the planets, and the stars.',
                    'image' => 'astro.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 2,
                    'name' => 'Chemistry',
                    'description' => 'Chemistry is the scientific study of the properties and behavior of matter.',
                    'image' => 'chem.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 2,
                    'name' => 'Animals',
                    'description' => 'Animal, any of a group of multicellular eukaryotic organisms thought to have evolved independently from the unicellular eukaryotes',
                    'image' => 'animals.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 2,
                    'name' => 'Earth Science',
                    'description' => 'Earth science is the study of the Earth is structure, properties, processes, and four and a half billion years of biotic evolution.',
                    'image' => 'earthscience.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 3,
                    'name' => 'Algebra',
                    'description' => ' Algebra is the study of mathematical symbols and the rules for manipulating these symbols.',
                    'image' => 'algebra.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 3,
                    'name' => 'Analysis',
                    'description' => 'Analysis is the process of breaking a complex topic or substance into smaller parts in order to gain a better understanding of it.',
                    'image' => 'analysis.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 3,
                    'name' => 'Arithmetic',
                    'description' => 'The arithmetic mean is the simplest and most widely used measure of a mean, or average.',
                    'image' => 'arithmetic.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 3,
                    'name' => 'Trigonometry',
                    'description' => 'Trigonometry is a branch of mathematics that studies relationships between side lengths and angles of triangles.',
                    'image' => 'trigo.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 4,
                    'name' => 'Aesthetics.',
                    'description' => 'a set of principles concerned with the nature and appreciation of beauty, especially in art.',
                    'image' => 'aesthetics.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 4,
                    'name' => 'Epistemology',
                    'description' => 'The theory of knowledge, especially with regard to its methods, validity, and scope',
                    'image' => 'epi.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 4,
                    'name' => 'Ethics',
                    'description' => 'The branch of knowledge that deals with moral principles.',
                    'image' => 'ethics.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ],[
                    'category_id' => 4,
                    'name' => 'Logic',
                    'description' => 'Logic is an interdisciplinary field which studies truth and reasoning.',
                    'image' => 'logic.jpg',
                    'created_at' => date("Y-m-d H:i:s")
                ]
            ];
    
            DB::table('categories')->insert($categories);
    }
}
