<script setup lang="ts">
// import images
import contact1 from "../assets/images/contact-1.jpg";
import contact2 from "../assets/images/contact-2.jpg";
import contact3 from "../assets/images/contact-3.jpg";

const contactData = [
  {
    name: "James Andrew Broun-Ramsay",
    designation: "Sales Director",
    image: contact3,
    description:
      "James Andrew Broun-Ramsay is a highly experienced sales professional with a proven track record of success. He has a deep understanding of the needs of his clients and is able to develop and implement effective sales strategies that drive revenue growth. James is a strong communicator and is always willing to go the extra mile to ensure that his clients are satisfied with the services he provides. He is a true leader and is always looking for ways to improve his sales skills.",
  },
  {
    name: "Marie Antoinette",
    designation: "Chief Executive Officer",
    image: contact2,
    description:
      "Marie Antoinette is a highly successful businesswoman with a proven track record of success. She has a deep understanding of the needs of her clients and is able to develop and implement effective sales strategies that drive revenue growth. Marie is a strong communicator and is always willing to go the extra mile to ensure that her clients are satisfied with the services she provides. She is a true leader and is always looking for ways to improve her sales skills.",
  },
  {
    name: "Frederick Douglass",
    designation: "Investor Relations Manager",
    image: contact1,
    description:
      "Frederick Douglass is a highly successful businessman with a proven track record of success. He has a deep understanding of the needs of his clients and is able to develop and implement effective sales strategies that drive revenue growth. Frederick is a strong communicator and is always willing to go the extra mile to ensure that his clients are satisfied with the services he provides. He is a true leader and is always looking for ways to improve his sales skills.",
  },
];
</script>

<template>
  <div class="px-8 py-2 flex">
    <div class="shrink-0">
      <div
        v-for="contact in contactData"
        :key="contact.name"
        class="max-w-lg py-8"
      >
        <img
          :src="contact.image"
          alt="Contact"
          class="w-16 h-16 rounded-full object-cover mb-2"
        />
        <div class="flex items-end mb-2">
          <h4 class="text-2xl font-serif text-gray-600 mr-2">
            {{ contact.name }}
          </h4>
          <p class="text-gray-400">{{ contact.designation }}</p>
        </div>

        <p class="text-gray-400 text-sm leading-snug text-justify">
          {{ contact.description }}
        </p>
      </div>
    </div>

    <div class="w-10"></div>
    <div class="w-24 bg-fuchsia-100"></div>
    <div class="w-2"></div>
    <div class="w-full bg-yellow-100"></div>
    <div class="w-2"></div>
    <div class="w-24 bg-green-100"></div>
  </div>
</template>
