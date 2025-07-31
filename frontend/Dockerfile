FROM node:23-alpine AS build

ENV PNPM_HOME="/pnpm"
ENV PATH="$PNPM_HOME:$PATH"
RUN corepack enable

WORKDIR /app
COPY . .

RUN pnpm install
RUN pnpm build

FROM alpine

COPY --from=build /app/dist/ /usr/share/build/